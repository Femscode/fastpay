<?php

namespace App\Traits;

use App\Models\User;
use Flutterwave;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\DuplicateTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

trait TransactionTrait
{
    public function check_duplicate($type, $user_id, $amount = null, $title = null, $details = null)
    {
        if ($type == 'check') {

            $duplicate = DuplicateTransaction::where('user_id', $user_id)->first();
            // dd($duplicate);
            if ($duplicate !== null) {
                return [true,$duplicate];
            }
           
            $duplicate = DuplicateTransaction::create([
                'user_id' => $user_id,
                'title' => $title,
                'details' => $details,
                'amount' => $amount
            ]);
          
            return [false,$duplicate];
        } else {
            $duplicate = DuplicateTransaction::where('user_id', $user_id)->first();
            $duplicate->delete();
        }
    }
    public function reserve_account_monnify()
    {
        $user = Auth::user();
        //authentication to monnify
        $api_key = env('MON_API_KEY_TEST');
        $secret_key = env('MON_SECRET_KEY_TEST');

        // Encode API Key and Secret Key
        // $auth_str = base64_encode("$api_key:$secret_key");
        $auth_str = base64_encode("MK_TEST_A8C10B1WC9:FAACQZT5T9UZ1UESMZQ9C0DSYTHB17A1");


        // Set headers for HTTP request
        $headers = [
            'Authorization' => 'Basic ' . $auth_str,
        ];

        // Make HTTP request using Axios
        $response = Http::withHeaders($headers)
            ->post('https://sandbox.monnify.com/api/v1/auth/login', []);
        $response = json_decode($response, true);

        if ($response['requestSuccessful'] == false) {
            return 0;
        }
        // dd($response);
        $access_token = $response['responseBody']['accessToken'];
        // return $access_token;
        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $payment_response = Http::withHeaders($payment_headers)
            ->post('https://sandbox.monnify.com/api/v2/bank-transfer/reserved-accounts', [
                "accountReference" => Str::random(5),
                "accountName" => "Paycirclex " . $user->name,
                "currencyCode" => "NGN",
                "contractCode" => "1699178756",
                "customerEmail" => $user->email,
                // "bvn" => "21212121212",
                "customerName" => $user->name,
                "getAllAvailableBanks" => true
            ]);
        $c_response = json_decode($payment_response, true);
        if ($c_response['requestSuccessful'] == false) {
            return 0;
        }
        $accounts = $c_response['responseBody']['accounts'];
        foreach ($accounts as $account) {
            if ($account['bankCode'] == '035') {
                $user->account_wema = $account['accountNumber'];
            } elseif ($account['bankCode'] == '232') {
                $user->account_sterling = $account['accountNumber'];
            } elseif ($account['bankCode'] == '50515') {
                $user->account_moniepoint = $account['accountNumber'];
            } elseif ($account['bankCode'] == '058') {
                $user->account_gtb = $account['accountNumber'];
            } else {
            }
            $user->save();
        }

        return 1;
    }
    public function reserve_account_paystack()
    {
        $user = Auth::user();

        // generate virtual account from flutterwaves

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer FLWSECK_TEST-e48a3a97bfc6ebde9cf882118a5b1b86-X', // Replace with your actual secret key
        ])
            ->post('https://api.flutterwave.com/v3/virtual-account-numbers', [
                'email' => 'fasanyafemi@gmail.com',
                'is_permanent' => false,
                // 'bvn' => 12345678901,
                'tx_ref' => 'JPOL',
                'phonenumber' => '09058744473',
                'amount' => 100,
                'firstname' => 'Fasanya',
                'lastname' => 'Femi',
                'narration' => 'Fasanya femi virtual account',
            ]);

        // You can then access the response body and status code like this:
        $responseBody = $response->body(); // Get the response body as a string
        $responseStatusCode = $response->status(); // Get the HTTP status code

        // You can also convert the JSON response to an array or object if needed:
        $responseData = $response->json(); // Converts JSON response to an array
        dd($responseData, 'here');


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/virtual-account-numbers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "email": "developers@flutterwavego.com",
                "is_permanent": true,
                "bvn": 12345678901,
                "tx_ref": "VA12",
                "phonenumber": 08109328188,
                "firstname": "Angela",
                "lastname": "Ashley",
                "narration": "Angela Ashley-Osuzoka"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer {FLWSECK-6783766a1d9252ff39a03922d2261ba3-18a6c26a2fbvt-X}'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
        //generate virtual from paystack


        $full_name = str_word_count($user->name, 1); // Split the full name into an array of words

        $firstName = $full_name[0]; // First name is the first word
        $lastName = end($full_name);

        $url = "https://api.paystack.co/customer";
        $fields = [
            "email" => $user->email,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "phone" => "+234" . $user->phone
        ];
        $fields_string = http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $json_result = json_decode($result, true);
        $customer = $json_result['data']['customer_code'];
        $url = "https://api.paystack.co/dedicated_account";

        $fields = [
            "customer" => $customer,
            "preferred_bank" => "wema-bank",
            "phone" => "234" . $user->phone
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $c_response = json_decode($result, true);
        // dd($c_response);

        if ($c_response['status'] == false) {
            return 0;
        }

        $user->bank_name = $c_response['data']['bank']['name'];
        $user->account_name = $c_response['data']['account_name'];
        $user->account_no = $c_response['data']['account_number'];

        $user->save();


        return 1;
    }


    public function create_transaction($title, $reference, $details, $type, $amount, $user, $status)
    {
        //    dd($title, $details, $type, intval($amount),intval($user),$name);
        $r_user = User::find($user);
        $tranx =  Transaction::create([
            'user_id' => $user,
            'title' => $title,
            'reference' => $reference,
            'description' => $details,
            'before' => $r_user->balance,
            'type' => $type,
            'amount' => $amount,
            'status' => $status
        ]);
        if ($title == 'Fund Transfer') {
            $nuser = User::find($user);
            $nuser->balance -= $amount;

            $nuser->save();
            $tranx->after = $nuser->balance;
            $tranx->status = 1;
            $tranx->save();
        } elseif ($title == 'Data Purchase') {
            $nuser = User::find($user);
            if ($status == 1) {
                $nuser->balance -= $amount;
                $nuser->total_spent += $amount;
                $nuser->save();
                $tranx->after = $nuser->balance;
                $tranx->save();
                return $tranx->id;
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $nuser->balance;
                $nuser->save();
                $tranx->save();
            }
        } elseif ($title == 'Payment Received') {
            $nuser = User::find($user);
            $nuser->balance += $amount;

            $nuser->save();
            $tranx->after = $nuser->balance;

            $tranx->status = 1;
            $tranx->save();
        } elseif ($title == 'Account Funding') {

            $nuser = User::find($user);
            $nuser->balance += $amount;

            $nuser->save();
            $tranx->after = $nuser->balance;
            $tranx->status = 1;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Bonus Credited') {

            $nuser = User::find($user);
            $nuser->bonus += $amount;

            $nuser->save();
            $tranx->after = $nuser->balance;
            $tranx->status = 1;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Account Funded Through Transfer') {

            $nuser = User::find($user);
            $nuser->balance += $amount;

            $nuser->save();
            $tranx->after = $nuser->balance;
            $tranx->status = 1;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Pending Credit') {

            $nuser = User::find($user);
            $nuser->balance += $amount;

            $nuser->save();
            $tranx->after = $nuser->balance;
            $tranx->status = 2;
            $tranx->save();
            return $tranx->id;
        } elseif ($title == 'Fund Disbursement') {

            $nuser = User::find($user);
            if ($status == 1) {
                $nuser->balance -= $amount;
                $nuser->spent += $amount;
                $nuser->save();
                $tranx->after = $nuser->balance;
                $tranx->status = $status;
                $tranx->save();
            } else {

                $tranx->after = $nuser->balance;
                $tranx->status = $status;
                $tranx->save();
            }

            return $tranx->id;
        } elseif ($title == 'Funds Withdraw') {

            $nuser = User::find($user);
            if ($status == 1) {
                $nuser->balance -= $amount;
                $nuser->save();
                $tranx->after = $nuser->balance;
                $tranx->status = $status;
                $tranx->save();
            } else {

                $tranx->after = $nuser->balance;
                $tranx->status = $status;
                $tranx->save();
            }

            return $tranx->id;
        } elseif ($title == 'Airtime Purchase') {
            $nuser = User::find($user);
            if ($status == 1) {
                $nuser->balance -= $amount;
                $nuser->total_spent += $amount;
                $nuser->save();
                $tranx->after = $nuser->balance;
                $tranx->save();
                return $tranx->id;
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $nuser->balance;
                $nuser->save();
                $tranx->save();
            }
        } elseif ($title == 'Cable Subscription') {
            $nuser = User::find($user);
            if ($status == 1) {
                $nuser->balance -= $amount;
                $nuser->total_spent += $amount;
                $nuser->save();
                $tranx->after = $nuser->balance;
                $tranx->save();
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $nuser->balance;
                $nuser->save();
                $tranx->save();
            }
        } elseif ($title == 'Electricity Payment') {
            $nuser = User::find($user);
            if ($status == 1) {
                $nuser->balance -= $amount;
                $nuser->total_spent += $amount;
                $nuser->save();
                $tranx->after = $nuser->balance;
                $tranx->save();
                return $tranx->id;
            } else {
                $tranx->description = "Failed Transaction : " . $tranx->description;
                $tranx->after = $nuser->balance;
                $nuser->save();
                $tranx->save();
            }
        } else {
            $tranx->status = 0;
            $nuser = User::find($user);
            $tranx->after = $nuser->balance;
            $tranx->save();

            return "not_completed";
        }
    }
}
