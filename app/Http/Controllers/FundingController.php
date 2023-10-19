<?php

namespace App\Http\Controllers;

use Paystack;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\TransactionTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class FundingController extends Controller
{
    //
    use TransactionTrait;
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {

        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {

            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    public function oldcheckout(Request $request)
    {
        $this->validate($request, [

            'amount' => 'required',
        ]);
        $data['user'] = $user = Auth::user();
        $data['amount'] = $amount = $request->amount;
        $data['active'] = 'fundwallet';

        $data['public_key'] = env('FLW_PUBLIC_KEY');
        $data['callback_url'] = 'https://fastpay.cttaste.com/payment/callback';
        return view('dashboard.pay_with_card', $data);
    }
    // this checkout is for temporary virtual accounts and card, to be used with oldfundwallet.blade.php
    public function checkout(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'amount' => 'required',
        ]);
        $data['user'] = $user = Auth::user();
        $data['amount'] = $amount = $request->amount;
        $data['active'] = 'fundwallet';
        if ($request->type == 'card') {
            $data['public_key'] = env('FLW_PUBLIC_KEY');
            $data['callback_url'] = 'https://fastpay.cttaste.com/payment/callback';
            return view('dashboard.pay_with_card', $data);
        } else {
            $str_name = explode(" ", $user->name);
            $first_name = $str_name[0];
            $last_name = end($str_name);
            // return view('dashboard.direct_transfer',$data);


            $trx_ref = Str::random(7);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('FLW_SECRET_KEY'), // Replace with your actual secret key
            ])
                ->post('https://api.flutterwave.com/v3/virtual-account-numbers/', [
                    'email' => $user->email,
                    'is_permanent' => false,
                    // 'bvn' => 12345678901,
                    'tx_ref' => $trx_ref,
                    'phonenumber' => $user->phone,
                    'amount' => $amount,
                    'firstname' => $first_name,
                    'lastname' => $last_name,
                    'narration' => 'Fastpay/' . $first_name . '-' . $last_name,
                ]);

            // You can then access the response body and status code like this:
            $responseBody = $response->body(); // Get the response body as a string
            $responseStatusCode = $response->status(); // Get the HTTP status code

            // You can also convert the JSON response to an array or object if needed:
            $responseData = $response->json(); // Converts JSON response to an array
            // dd($responseData, 'here');
            $data['bank_name'] = $responseData['data']['bank_name'];
            $data['account_no'] = $responseData['data']['account_number'];
            $data['amount'] = $responseData['data']['amount'];
            $data['expiry_date'] = $responseData['data']['expiry_date'];
            return view('dashboard.direct_transfer', $data);
        }
        // dd($request->all(), $request->amount/100);

    }
    public function handleFLWCallback()
    {
        return redirect()->route('dashboard');
    }
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        return redirect()->route('dashboard');
    }
    public function webhook_payment_for_paystack(Request $request)
    {
        file_put_contents(__DIR__ . '/paystacklog.txt', json_encode($request->all(), JSON_PRETTY_PRINT), FILE_APPEND);
        $email = $request->input('data.customer.email');
        $r_amountpaid = intval(($request->input('data.amount')) / 100);
        if ($request->input('data.channel') == 'dedicated_nuban') {
            // $amountpaid = $r_amountpaid - 50;
            $amountpaid = $r_amountpaid;
        } elseif ($r_amountpaid < 2500) {
            // $amountpaid = $r_amountpaid - intval((0.02 * $r_amountpaid));
            $amountpaid = $r_amountpaid;
        } else {
            // $amountpaid = $r_amountpaid - intval((0.02 * $r_amountpaid + 100));
            $amountpaid = $r_amountpaid;
        }
        $user = User::where('email', $email)->firstOrFail();
        $details = "Account credited with NGN" . $amountpaid;
        $this->create_transaction('Account Funding', $request->input('data.reference'), $details, 'credit', $amountpaid, $user->id, 1);
        if ($user->first_time == 0) {
            $bonus = intval(0.1 * $amountpaid);
            $details = "You've received a welcome bonus of NGN" . $bonus;
            $this->create_transaction('Bonus Credited', $request->input('data.reference'), $details, 'credit',  $bonus, $user->id, 1);
            $user->first_time = 1;
            $user->save();
        }
        return response()->json("OK", 200);
    }

    public function webhook_payment(Request $request)
    {
        file_put_contents(__DIR__ . '/flwlog.txt', json_encode($request->all(), JSON_PRETTY_PRINT), FILE_APPEND);

        $email = $request->input('data.customer.email');
        $r_amountpaid = intval($request->input('data.amount'));

        $amountpaid = $r_amountpaid;
        if ($amountpaid <= 200) {
            $charges = 10;
            $amountpaid -= $charges;
        } elseif ($amountpaid < 1000) {
            $charges = 30;
            $amountpaid -= $charges;
        } elseif ($amountpaid < 5000) {
            $charges = 50;
            $amountpaid -= $charges;
        } else {
            $charges = 100;
            $amountpaid -= $charges;
        }

        $user = User::where('email', $email)->firstOrFail();
        $details = "Account credited with NGN" . $amountpaid. " | Charges :NGN".$charges;
        // file_put_contents(__DIR__ . '/gethere.txt', json_encode($request->all(), JSON_PRETTY_PRINT), FILE_APPEND);
        $this->create_transaction('Account Funding', $request->input('data.id'), $details, 'credit', $amountpaid, $user->id, 1);
        if ($user->first_time == 0) {
            $bonus = intval(0.1 * $amountpaid);
            $details = "You've received a welcome bonus of NGN" . $bonus;
            $this->create_transaction('Bonus Credited', $request->input('data.id'), $details, 'credit',  $bonus, $user->id, 1);
            $user->first_time = 1;
            $user->save();
        }
        return response()->json("OK", 200);
    }
    public function vpay_webhook_payment(Request $request)
    {
        file_put_contents(__DIR__ . '/vpaylog.txt', json_encode($request->all(), JSON_PRETTY_PRINT), FILE_APPEND);

        $account_no = $request->input('account_number');
        $r_amountpaid = intval($request->input('amount'));
        $amountpaid = $r_amountpaid;
        if ($amountpaid <= 200) {
            // No change needed
        } elseif ($amountpaid < 1000) {
            $amountpaid -= 30;
        } elseif ($amountpaid < 5000) {
            $amountpaid -= 50;
        } else {
            $amountpaid -= 100;
        }

        $user = User::where('account_vfd', $account_no)
        ->orWhere('account_gtb', $account_no)
        ->orWhere('account_moniepoint', $account_no)
        ->firstOrFail();
        $details = "Account credited with NGN" . $amountpaid . ' through virtual account';
        // file_put_contents(__DIR__ . '/gethere.txt', json_encode($request->all(), JSON_PRETTY_PRINT), FILE_APPEND);
        $this->create_transaction('Account Funding', $request->input('session_id'), $details, 'credit', $amountpaid, $user->id, 1);
        if ($user->first_time == 0) {
            $bonus = intval(0.1 * $amountpaid);
            $details = "You've received a welcome bonus of NGN" . $bonus;
            $this->create_transaction('Bonus Credited', $request->input('session_id'), $details, 'credit',  $bonus, $user->id, 1);
            $user->first_time = 1;
            $user->save();
        }
        return response()->json("OK", 200);
    }
    public static function computeSHA512TransactionHash($stringifiedData, $clientSecret)
    {
        $computedHash = hash_hmac('sha512', $stringifiedData, $clientSecret);
        return $computedHash;
    }

    public function transfer()
    {
        $data['user'] = Auth::user();
        $data['active'] = 'transfer';
        return view('dashboard.transfer', $data);
    }

    public function pay_cttaste($slug)
    {
        $data['user'] = Auth::user();
        $data['active'] = 'pay_cttaste';
        $order =  DB::connection('mysql2')->table('orders')->where('order_id', $slug)->first();
        if ($order) {
            if ($order->status == 1) {
                $data['payment_status'] = 'Paid';
            } else {
                $data['payment_status'] = 'Not Paid';
            }
            if ($order->payment_time == null) {
                $data['payment_time'] = NULL;
            } else {
                $dateTime = $order->payment_time;
                $data['payment_time'] = Carbon::parse($dateTime)->diffForHumans();
            }
        } else {
            $data['payment_status'] = NULL;
            $data['payment_time'] = NULL;
        }


        // dd($data);

        return view('dashboard.paycttaste', $data);
    }
    public function pay_order($order_id)
    {
        $data['user'] = Auth::user();
        $data['active'] = 'pay_cttaste';
        $data['order_id'] = $order_id;
        return view('dashboard.paycttaste', $data);
    }
    public function verify_id(Request $request)
    {

        $user = User::where('phone', $request->account_id)->first();

        if ($user == null) {
            return false;
        }
        return $user->name;
    }
    public function verify_order(Request $request)
    {
        //CTS-MXPH09riG6 the order id
        $order = DB::connection('mysql2')->table('orders')->where('order_id', $request->order_id)->first();
        if ($order == null) {
            return false;
        }
        $rest = DB::connection('mysql2')->table('users')->where('id', $order->user_id)->first();
        if ($rest == null) {
            return false;
        }
        $order->restaurant_name = $rest->name;

        if ($order == null) {
            return false;
        }
        return $order;
    }
    public function make_transfer(Request $request)
    {
        $user = Auth::user();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            return "Incorrect Pin";
        }


        if ($user == null) {
            return "Unauthenticated";
        }
        $amount = $request->amount;
        $account_id = $request->account_id;

        $beneficiary = User::where('phone', $account_id)->first();
        //check if beneficiary exists
        if ($beneficiary == null) {
            return "Invalid account";
        }
        //check for the user balance, then fire the transaction
        if ($user->balance >= $amount) {
            $reference = 'fund_transfer_' . Str::random(7);
            $details = "Transfer of NGN" . $amount . ' to ' . $beneficiary->name;
            $check = $this->check_duplicate('check', $user->id);
            if ($check == true) {
                return "Duplicate Transaction";
            }
            $this->create_transaction('Fund Transfer', $reference, $details, 'debit', $amount, $user->id, 1);
            $this->check_duplicate("Delete", $user->id);
            $reference = 'payment_received_' . Str::random(7);
            $details = "Payment of NGN" . $amount . ' from ' . $user->name . ' received successfully!';
            $this->create_transaction('Payment Received', $reference, $details, 'credit', $amount, $beneficiary->id, 1);
            return true;
        }
    }
    public function pay_for_order(Request $request)
    {
        $user = Auth::user();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            return "Incorrect Pin";
        }
        if ($user == null) {
            return "Unauthenticated";
        }
        $amount = $request->amount;
        $order_id = $request->account_id;
        $order = DB::connection('mysql2')->table('orders')->where('order_id', $request->order_id)->first();
        if ($order == null) {
            return "Invalid Order";
        }
        if ($order->user_id == 53 || $order->user_id == 38) {
            // $amount = $order->total_price + $order->delivery_amount + 50;
            $amount = $order->total_price + 50;
        } else {
            $amount = $order->total_price;
        }

        $rest = DB::connection('mysql2')->table('users')->where('id', $order->user_id)->first();
        if ($rest == null) {
            return "Beneficiary not found";
        }
        $restaurant_phone = $rest->phone;
        if (strlen($restaurant_phone) == 11) {
            $restaurant_phone = substr($restaurant_phone, 1);
        }
        // dd($restaurant_phone);

        //check for the user balance, then fire the transaction
        if ($user->balance >= $amount) {
            $reference = 'fund_transfer_' . Str::random(7);
            $details = "Transfer of NGN" . $amount . ' to ' . $rest->name;
            $check = $this->check_duplicate('check', $user->id);
            if ($check == true) {
                return "Duplicate Transaction";
            }
            $this->create_transaction('Fund Transfer', $reference, $details, 'debit', $amount, $user->id, 1);
            $this->check_duplicate("Delete", $user->id);
            $reference = 'payment_received_' . Str::random(7);
            $data = [
                'order_id' => $order->id,
                'rest_id' => $rest->id,
                'amount' => $amount,
                'before_balance' => $rest->balance,
                'after_balance' => $rest->balance + $amount,
                'reference' => $reference,
                'type' => 'credit',
                'title' => 'Payment of order via fastpay',
                'details' => 'Payment of NGN' . $amount . ' from ' . $user->name,
                'customer_name' => $user->name,
                'customer_phone' => $user->phone,
                'status' => 1
            ];
            DB::connection('mysql2')->table('transactions')->insert($data);
            DB::connection('mysql2')->table('orders')->where('order_id', $request->order_id)->update(['status' => 1, 'payment_time' => Carbon::now()]);
            DB::connection('mysql2')->table('users')->where('id', $rest->id)->update(['balance' => $rest->balance + $amount]);
            return true;
        }
    }
    //functions for the vpay
    public function fundwallet()
    {

        $data['user'] = $user = Auth::user();
        $data['active'] = 'fundwallet';
        // dd($user);

        return view('dashboard.oldfundwallet',$data);
        // $reserve = $this->reserve_account_paystack();
        if ($user->account_vfd == null) {
            $reserve = $this->reserve_account_vpay();
            if ($reserve == false) {
                return view('dashboard.oldfundwallet', $data);
            }
            // dd($reserve);
        }
        return view('dashboard.fundwallet', $data);
    }
    private function vtpay_auth()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'publicKey' => env('VPAY_PUBLICKEY')
        ])
            ->post('https://services2.vpay.africa/api/service/v1/query/merchant/login', [
                'username' => env('VPAY_USERNAME'),
                'password' => env('VPAY_PASSWORD'),
            ]);
        $response_json = json_decode($response, true);
        // dd($response_json);
        if ($response_json['status'] == false) {
            return false;
        }
        return $response_json['token'];
    }
    private function reserve_account_vpay()
    {

        $user = Auth::user();
        $name = $user->name;
        $parts = explode(' ', $name);

        if (count($parts) == 2) {
            $firstName = $parts[0];
            $lastName = $parts[1];
        } else {
            $firstName = $parts[0];
            $lastName = '';
        }
        $access_token = $this->vtpay_auth();
        // $access_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJmaXJzdG5hbWUiOiJPbHV3YXBlbHVtaSIsImJ1c2luZXNzbmFtZSI6IkN0aG9zdGVsIFByb2R1Y3RzIEFuZCBTZXJ2aWNlcyIsImJ1c2luZXNzaWQiOiJZTVVMTCIsInZlcnNpb24iOjEsInVzZXIiOiI2NTI1NjgzNjEyZWNkYmU1ZTA4ZjliNjMiLCJpYXQiOjE2OTczNzUzMjIsImV4cCI6MTY5NzM3NTYyMn0.-s_zcWQm40lgHuWyqE0nIMiQ70JjLMsr6puQScaWqKA';
        // echo $access_token;

        // $response_json = json_decode($response, true);
        // dd($response_json);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'publicKey' => env('VPAY_PUBLICKEY'),
            'b-access-token' => $access_token,
        ])
            ->post('https://services2.vpay.africa/api/service/v1/query/customer/add/', [
                'email' => $user->email,
                'phone' => $user->phone,
                'contactfirstname' => $firstName,
                'contactlastname' => $lastName,

            ]);
        $response_json = json_decode($response, true);

        if (isset($response_json['status']) &&  $response_json['status'] == false) {
            return false;
        }
        // dd($response_json);

        $customer_id = $response_json['id'];
        // $customer_id = '6525683712ecdbe5e08f9ba0';

        $customer_response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'publicKey' => env('VPAY_PUBLICKEY'),
            'b-access-token' => $access_token,
        ])
            ->get('https://services2.vpay.africa/api/service/v1/query/customer/' . $customer_id . '/show');
        $customer_res_json = json_decode($customer_response, true);
        if (!isset($customer_res_json['nuban'])) {
            return false;
        }

        $user->account_vfd = $customer_res_json['nuban'];
        $user->save();



        $other_bank_response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'publicKey' => env('VPAY_PUBLICKEY'),
            'b-access-token' => $access_token,
        ])
            ->post('https://services2.vpay.africa/api/service/v1/query/customer/otherbanks/virtualaccount/update/', [
                'vfdvirtualaccount' => $customer_res_json['virtualaccounts'][0]['nuban'],
                'banks' => ["000023"],
                // 'banks' => ["000023",'993,'058]
            ]);
        $final_response = json_decode($other_bank_response, true);
        if (isset($final_response['status']) && $final_response['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function reserve_account_everyone()
    {

        // $user = Auth::user();
        $users = User::all();
        foreach ($users as $user) {

            $name = $user->name;
            $parts = explode(' ', $name);

            if (count($parts) == 2) {
                $firstName = $parts[0];
                $lastName = $parts[1];
            } else {
                $firstName = $parts[0];
                $lastName = '';
            }
            $access_token = $this->vtpay_auth();
            // $access_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJmaXJzdG5hbWUiOiJPbHV3YXBlbHVtaSIsImJ1c2luZXNzbmFtZSI6IkN0aG9zdGVsIFByb2R1Y3RzIEFuZCBTZXJ2aWNlcyIsImJ1c2luZXNzaWQiOiJZTVVMTCIsInZlcnNpb24iOjEsInVzZXIiOiI2NTI1NjgzNjEyZWNkYmU1ZTA4ZjliNjMiLCJpYXQiOjE2OTczNzUzMjIsImV4cCI6MTY5NzM3NTYyMn0.-s_zcWQm40lgHuWyqE0nIMiQ70JjLMsr6puQScaWqKA';
            // echo $access_token;

            // $response_json = json_decode($response, true);
            // dd($response_json);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'publicKey' => env('VPAY_PUBLICKEY'),
                'b-access-token' => $access_token,
            ])
                ->post('https://services2.vpay.africa/api/service/v1/query/customer/add/', [
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'contactfirstname' => $firstName,
                    'contactlastname' => $lastName,

                ]);
            $response_json = json_decode($response, true);

            if (isset($response_json['status']) &&  $response_json['status'] == false) {
                return false;
            }
            // dd($response_json);

            $customer_id = $response_json['id'];
            // $customer_id = '6525683712ecdbe5e08f9ba0';

            $customer_response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'publicKey' => env('VPAY_PUBLICKEY'),
                'b-access-token' => $access_token,
            ])
                ->get('https://services2.vpay.africa/api/service/v1/query/customer/' . $customer_id . '/show');
            $customer_res_json = json_decode($customer_response, true);
            if (!isset($customer_res_json['nuban'])) {
                return false;
            }

            $user->account_vfd = $customer_res_json['nuban'];
            $user->save();
        }
    }
}
