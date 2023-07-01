<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Cable;
use App\Models\ComingSoon;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\TransactionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    use TransactionTrait;

    public function data()
    {
        $data['user'] = Auth::user();
        $data['active'] = 'data';
        return view('subscription.buydata', $data);
    }
    public function buydata(Request $request)
    {
       
        $user = Auth::user();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Pin!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
        }
        $phone_number = $request->phone_number;
        if(strlen($request->phone_number) == 10) {
            $phone_number = "0".$request->phone_number;
        }
      
        $data = Data::where('plan_id', $request->plan)->where('network', $request->network)->first();
        if ($data == null) {
            $response = [
                'success' => false,
                'message' => 'Invalid Plan!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
           
        }
        //check balance
        if ($user->balance < $data->data_price) {
            $response = [
                'success' => false,
                'message' => 'Insufficient balance for the plan you want to get!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
           
        }

        //check duplicate
        $check = $this->check_duplicate('check', $user->id);
        if ($check == true) {
            $response = [
                'success' => false,
                'message' => 'Duplicate Transaction!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
           
        }
        //purchase the data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/data.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'network' => $request->network,
                'mobileno' => $phone_number,
                'dataplan' => $request->plan,
                'client_reference' => 'buy_data_' . Str::random(7), //update this on your script to receive webhook notifications
            ),
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $response_json = json_decode($response, true);

        if ($response_json['success'] === "true") {
            $details = $response_json['network'] . " Data Purchase of " . $response_json['dataplan'] . " on " . $request->phone_number;
            
           $trans_id = $this->create_transaction('Data Purchase', $response_json['reference_no'], $details, 'debit', $data->data_price, $user->id, 1);
            $transaction = Transaction::find($trans_id);
            $transaction->phone_number = $phone_number;
            $transaction->network = $request->network;
            $transaction->plan_id = $request->plan;
            $transaction->redo = 1;
            $transaction->save();
            // Transaction was successful
            // Do something here
        } else {
            $reference = 'failed_data_'. Str::random(5);
            $this->create_transaction('Data Purchase', $reference, 'Failed data purchase', 'debit', $data->data_price, $user->id, 0);
        }
        $this->check_duplicate("Delete", $user->id);

        curl_close($curl);
        return $response;
      

        $data['user'] = Auth::user();
        return view('subscription.buydata', $data);
    }
    public function redo_transaction(Request $request) {
        $user = Auth::user();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Pin!',
                'auto_refund_status' => 'Nil'
            ];
            return response()->json($response);
        }
        $tranx = Transaction::find($request->transaction_id);
        if($tranx->title == "Airtime Purchase") {
            $phone_number = $tranx->phone_number;
            
            if ($user->balance < $tranx->amount) {
                $response = [
                    'success' => false,
                    'message' => 'Insufficient Balance for airtime you want to get!',
                    'auto_refund_status' => 'Nil'
                ];
            
                return response()->json($response);
            }
    
            //check duplicate
            $check = $this->check_duplicate('check', $user->id);
            if ($check == true) {
                $response = [
                    'success' => false,
                    'message' => 'Duplicate transaction, please try again in few minutes time!',
                    'auto_refund_status' => 'Nil'
                ];
            
                return response()->json($response);
            }
            //purchase the data
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://easyaccessapi.com.ng/api/airtime.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    'network' => $tranx->network,
                    'mobileno' => $phone_number,
                    'amount' => $tranx->real_amount,
                    'airtime_type' => 001,
                    'client_reference' => 'buy_airtime_' . Str::random(7), //update this on your script to receive webhook notifications
                ),
                CURLOPT_HTTPHEADER => array(
                    "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                    "cache-control: no-cache"
                ),
            ));
            $response = curl_exec($curl);
            $response_json = json_decode($response, true);
    
            if ($response_json['success'] === "true") {
                $details = $response_json['network'] . " Airtime Purchase of NGN" . $tranx->real_amount . " on " . $phone_number;
                $trans_id = $this->create_transaction('Airtime Purchase', $response_json['reference_no'], $details, 'debit', $tranx->discounted_amount, $user->id, 1);
                $transaction = Transaction::find($trans_id);
                $transaction->phone_number = $phone_number;
                $transaction->network = $tranx->network;
                $transaction->discounted_amount = $tranx->discounted_amount;
                $transaction->redo = 1;
                $transaction->save();
                // Transaction was successful
                // Do something here
            } else {
                $reference = 'failed_airtime_'. Str::random(5);
                $details = "Airtime Purchase of NGN" . $request->amount . " on " . $request->phone_number;
                $this->create_transaction('Airtime Purchase', $reference, $response_json['message'], 'debit', $request->discounted_amount, $user->id, 0);
            }
            $this->check_duplicate("Delete", $user->id);
    
            curl_close($curl);
            return $response;

        }
        elseif($tranx->title == "Data Purchase") {
            $phone_number = $tranx->phone_number;
           
          
            $data = Data::where('plan_id', $tranx->plan_id)->where('network', $tranx->network)->first();
            if ($data == null) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid Plan!',
                    'auto_refund_status' => 'Nil'
                ];
            
                return response()->json($response);
               
            }
            //check balance
            if ($user->balance < $data->data_price) {
                $response = [
                    'success' => false,
                    'message' => 'Insufficient balance for the plan you want to get!',
                    'auto_refund_status' => 'Nil'
                ];
            
                return response()->json($response);
               
            }
    
            //check duplicate
            $check = $this->check_duplicate('check', $user->id);
            if ($check == true) {
                $response = [
                    'success' => false,
                    'message' => 'Duplicate Transaction!',
                    'auto_refund_status' => 'Nil'
                ];
            
                return response()->json($response);
               
            }
            //purchase the data
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://easyaccessapi.com.ng/api/data.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    'network' => $tranx->network,
                    'mobileno' => $phone_number,
                    'dataplan' => $tranx->plan_id,
                    'client_reference' => 'buy_data_' . Str::random(7), //update this on your script to receive webhook notifications
                ),
                CURLOPT_HTTPHEADER => array(
                    "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                    "cache-control: no-cache"
                ),
            ));
            $response = curl_exec($curl);
            $response_json = json_decode($response, true);
    
            if ($response_json['success'] === "true") {
                $details = $response_json['network'] . " Data Purchase of " . $response_json['dataplan'] . " on " . $phone_number;
                
                $trans_id = $this->create_transaction('Data Purchase', $response_json['reference_no'], $details, 'debit', $data->data_price, $user->id, 1);
                $transaction = Transaction::find($trans_id);
                $transaction->phone_number = $phone_number;
                $transaction->network = $tranx->network;
                $transaction->plan_id = $tranx->plan_id;
                $transaction->redo = 1;
                $transaction->save();
                // Transaction was successful
                // Do something here
            } else {
                $reference = 'failed_data_'. Str::random(5);
                $this->create_transaction('Data Purchase', $reference, 'Failed data purchase', 'debit', $data->data_price, $user->id, 0);
            }
            $this->check_duplicate("Delete", $user->id);
    
            curl_close($curl);
            return $response;
          
    

        }
        elseif($tranx->title == 'Cable Subscription') {

        }
        elseif($tranx->title == 'Electricity Payment') {

        }
        else {
            $response = [
                'success' => false,
                'message' => 'Invalid Transaction!',
                'auto_refund_status' => 'Nil'
            ];
            return response()->json($response);
        }


        dd($request->all(),$tranx);
    }

    public function buyCable(Request $request)
    {
        $user = Auth::user();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Pin!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
        }
        if ($request->plan == 'renew') {
            $amount = $request->amount;
        } else {

            //check balance
            $cable = Cable::where('company', $request->cable_type)->where('plan_id', $request->plan)->first();
            if ($cable == null) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid Plan!',
                    'auto_refund_status' => 'Nil'
                ];
            
                return response()->json($response);
               
            }
            $amount = $cable->real_price;
        }
        if ($user->balance < $amount) {
            $response = [
                'success' => false,
                'message' => 'Insufficient balance for the plan you want to get!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
           
        }

        //check duplicate
        $check = $this->check_duplicate('check', $user->id);
        if ($check == true) {
            $response = [
                'success' => false,
                'message' => 'Duplicate Transaction, try again in few minuetes time!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
          
        }
        //purchase the data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/paytv.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'company' => $request->cable_type,
                'iucno' => $request->decoder_number,
                'package' => $request->plan,
            ),
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);

        $response_json = json_decode($response, true);

        if ($response_json['success'] === "true") {
            file_put_contents(__DIR__ . '/cablelog.txt', json_encode($response_json, JSON_PRETTY_PRINT), FILE_APPEND);
       
            $details = $response_json['package'] . "subscription made successfully, amount: " . $amount;
            $this->create_transaction('Cable Subscription', $response_json['reference_no'], $details, 'debit', $amount, $user->id, 1);

            // Transaction was successful
            // Do something here
        } else {
            $reference = 'failed_tv_'. Str::random(5);
            $details = "Failed Tv subscription, amount: " . $amount;
            $this->create_transaction('Cable Subscription', $reference, $details, 'debit', $amount, $user->id, 0);
        }
        $this->check_duplicate("Delete", $user->id);

        curl_close($curl);
        return $response;
    }
    public function notify(Request $request) {
      
        $check = ComingSoon::where('email',$request->email)->first();
        if($check) {
            return redirect()->back()->with('message', 'Email address already included in the waiting list, thanks for your anticipation!');
        } else {
            ComingSoon::create(['email' => $request->email]);
            return redirect()->back()->with('message', 'Email address included in the waiting list, thanks for your anticipation!');
        }
    }
    public function buyElectricity(Request $request)
    {
        $user = Auth::user();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Pin!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
          
        }
        $amount = $request->amount;
        if ($amount >= 1100) {
            $discounted_amount = $amount - (0.1 * $amount);
        } else {
            $discounted_amount = $amount;
        }
        // dd($request->all(),$discounted_amount);
        if ($user->balance < $amount) {
            $response = [
                'success' => false,
                'message' => 'Insufficient balance for the plan you want to get!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
        }

        //check duplicate
        $check = $this->check_duplicate('check', $user->id);
        if ($check == true) {
            $response = [
                'success' => false,
                'message' => 'Duplicate transactions, please try again in few more minuetes!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
        }
        //purchase the data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/payelectricity.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'company' => $request->company,
                'metertype' => $request->meter_type,
                'meterno' => $request->meter_number,
                'amount' => $discounted_amount,
            ),
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $response_json = json_decode($response, true);

        if ($response_json['success'] === "true") {
            file_put_contents(__DIR__ . '/electricitylog.txt', json_encode( $response_json, JSON_PRETTY_PRINT), FILE_APPEND);
       
            $details = "Payment for " . $response_json['message']['content']['transactions']['product_name'] . ", Meter No: " . $request->meter_number . ". Amount : NGN" . $amount ." ". $response_json['message']['purchased_code'];
            $this->create_transaction('Electricity Payment', $response_json['message']['requestId'], $details, 'debit', $amount, $user->id, 1);

            // Transaction was successful
            // Do something here
        } else {

            $details = "Failed Electricity Payment, amount: " . $amount;
            $reference = 'failed_electricity_' . Str::random(10);
            $this->create_transaction('Electricity Payment', $reference, $details, 'debit', $amount, $user->id, 0);
        }
        $this->check_duplicate("Delete", $user->id);

        curl_close($curl);
        return $response;
    }

    public function buyairtime(Request $request)
    {
        $user = Auth::user();
        $hashed_pin = hash('sha256', $request->pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect pin!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
           
        }
        $phone_number = $request->phone_number;
        if(strlen($request->phone_number) == 10) {
            $phone_number = "0".$request->phone_number;
        }
        if ($user->balance < $request->amount) {
            $response = [
                'success' => false,
                'message' => 'Insufficient Balance for airtime you want to get!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
        }

        //check duplicate
        $check = $this->check_duplicate('check', $user->id);
        if ($check == true) {
            $response = [
                'success' => false,
                'message' => 'Duplicate transaction, please try again in few minutes time!',
                'auto_refund_status' => 'Nil'
            ];
        
            return response()->json($response);
        }
        //purchase the data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/airtime.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'network' => $request->network,
                'mobileno' => $phone_number,
                'amount' => $request->amount,
                'airtime_type' => 001,
                'client_reference' => 'buy_data_' . Str::random(7), //update this on your script to receive webhook notifications
            ),
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $response_json = json_decode($response, true);

        if ($response_json['success'] === "true") {
            $details = $response_json['network'] . " Airtime Purchase of NGN" . $request->amount . " on " . $request->phone_number;
            $trans_id = $this->create_transaction('Airtime Purchase', $response_json['reference_no'], $details, 'debit', $request->discounted_amount, $user->id, 1);
            $transaction = Transaction::find($trans_id);
            $transaction->phone_number = $phone_number;
            $transaction->network = $request->network;
            $transaction->discounted_amount = $request->discounted_amount;
            $transaction->real_amount = $request->amount;
            $transaction->redo = 1;
            $transaction->save();
            // Transaction was successful
            // Do something here
        } else {
            $reference = 'failed_airtime_'. Str::random(5);
            $details = "Airtime Purchase of NGN" . $request->amount . " on " . $request->phone_number;
            $this->create_transaction('Airtime Purchase', $reference, $response_json['message'], 'debit', $request->discounted_amount, $user->id, 0);
        }
        $this->check_duplicate("Delete", $user->id);

        curl_close($curl);
        return $response;
    }
    public function airtime()
    {
        $data['user'] = Auth::user();
        $data['active'] = 'airtime';
        return view('subscription.buyairtime', $data);
    }
    public function electricity()
    {
        $data['user'] = Auth::user();
        $data['active'] = 'electricity';
        return view('subscription.electricity', $data);
    }
    public function cable()
    {
        $data['user'] = Auth::user();
        $data['active'] = 'cable';
        return view('subscription.cable', $data);
    }
    function validateNigerianPhoneNumber($phoneNumber)
    {
        // Regular expressions for Nigerian phone numbers
        $mtnRegex = '/^(234|\\+234|0)(703|706|803|806|810|813|814|903|904|906|0703|0706|0803|0806|0810|0813|0814|0903|0904|0906)\\d{7}$/';
        $gloRegex = '/^(234|\\+234|0)(705|805|807|811|815|905|0705|0805|0807|0811|0815|0905)\\d{7}$/';
        $airtelRegex = '/^(234|\\+234|0)(701|708|802|808|902|0701|0708|0802|0808|0902)\\d{7}$/';
        $etisalatRegex = '/^(234|\\+234|0)(809|810|0819|0818|0908|0909)\\d{7}$/';

        // Remove any spaces, dashes, or parentheses from the phone number
        $phoneNumber = preg_replace('/[\s\-()]+/', '', $phoneNumber);

        // Test the phone number against each network's regular expression
        if (preg_match($mtnRegex, $phoneNumber)) {
            return 1;
        } elseif (preg_match($gloRegex, $phoneNumber)) {
            return 2;
        } elseif (preg_match($airtelRegex, $phoneNumber)) {
            return 3;
        } elseif (preg_match($etisalatRegex, $phoneNumber)) {
            return 4;
        } else {
            return 0;
        }
    }

    public function fetchnetwork($phone)
    {
        if (strlen($phone) == 10) {
            $phone = "0" . $phone;
        }
        $network = $this->validateNigerianPhoneNumber($phone);
        return $network;
    }
    public function fetchplan($network)
    {

        $data = Data::where('network', $network)->orderBy('actual_price', 'ASC')->get();

        return $data;
    }
    public function fetch_cable_plan($company)
    {

        $data = Cable::where('company', $company)->orderBy('actual_price', 'ASC')->get();

        return $data;
    }
    public function fetch_meter_details(Request $request)
    {
       
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/verifyelectricity.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'company' => $request->service_type,
                'metertype' => $request->meter_type,
                'meterno' => $request->meter_number,
                'amount' => 1000,
            ),
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response_json = json_decode($response, true);
        return $response_json;
    }
    public function fetch_decoder_details(Request $request)
    {
        // dd($request->all(),'decoder_details');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://easyaccessapi.com.ng/api/verifytv.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'company' => $request->cable_type,
                'iucno' => $request->decoder_number,
                // 'company' => 02,
                // 'iucno' => '7032054653',
            ),
            CURLOPT_HTTPHEADER => array(
                "AuthorizationToken: ".env('EASY_ACCESS_AUTH'), //replace this with your authorization_token
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
        $response_json = json_decode($response, true);
        return $response_json;
    }
}
