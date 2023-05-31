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

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        return redirect()->route('dashboard');
    }
    public function webhook_payment(Request $request)
    {
        file_put_contents(__DIR__ . '/paystacklog.txt', json_encode($request->all(), JSON_PRETTY_PRINT), FILE_APPEND);
        $email = $request->input('data.customer.email');
        $r_amountpaid = ($request->input('data.amount')) / 100;
        if ($request->input('data.channel') == 'dedicated_nuban') {
            $amountpaid = $r_amountpaid - 50;
        } elseif ($r_amountpaid < 2500) {
            $amountpaid = $r_amountpaid - (0.02 * $r_amountpaid);
        } else {
            $amountpaid = $r_amountpaid - (0.02 * $r_amountpaid + 100);
        }

        $user = User::where('email', $email)->firstOrFail();
        $details = "Account credited with NGN" . $amountpaid;
        $this->create_transaction('Account Funding', $request->input('data.reference'), $details, 'credit', $amountpaid, $user->id, 1);

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
}
