<?php

namespace App\Http\Controllers;

use App\Models\Payee;
use App\Models\Payroll;
use App\Models\Transaction;
use App\Traits\TransactionTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    use TransactionTrait;
    // Funding wallet
    //2.  deduction of user's balance for successful batch transactions

    //6. audit trail as well
    // test the bulk charges
    // editing of payroll name
    // Calculate charges
    // Allow admins to click on remove charges from payee
    // 7. Recharge account top up pin
    // 8. Transactions

    public function monnify_login_access_token()
    {
        if (session()->has('access_token')) {
            // The session exists, and the access_token key is set, so you can use the stored token
            $access_token = session()->get('access_token');
        } else {

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
            $access_token = $response['responseBody']['accessToken'];

            session_start();

            $expires_in = $response['responseBody']['expiresIn'];

            session()->put('access_token', $access_token, $expires_in / 60);
        }
        return $access_token;
    }
    public function initialize_payment(Request $request)
    {
        $user = Auth::user();
        $pin = $request->pin;
        $hashed_pin = hash('sha256', $pin);
        if ($user->pin !== $hashed_pin) {
            return array("Invalid Pin", 'malo');
        }
        $payroll = Payroll::where('uuid', $request->payroll_id)->first();

        if ($payroll->is_processed == 1) {
            $payee1 = Payee::where('payroll_id', $payroll->uuid)->where('pay_status', 1)->where('status', 0)->get();
            $payee2 = Payee::where('payroll_id', $payroll->uuid)->where('pay_status', 1)->where('status', 4)->get();
            $payees =  $payee1->merge($payee2);
        } else {
            $payees = Payee::where('payroll_id', $payroll->uuid)->where('pay_status', 1)->where('status', 4)->get();
        }

        $transfer_amount = $payees->sum('amount');
        $charges = $payees->sum('charges');
        $total_amount = $transfer_amount + $charges;
        //check if the user amount is sufficient for the transaction.
        if ($user->balance < $total_amount) {
            return array("Insufficient Fund", 'error');
        }
        $access_token = $this->monnify_login_access_token();
        //make the api call to make the transfer
        $payment_data = [
            "title" => $payroll->title . "-paycirclex-payment",
            "batchReference" => "batchreference" . Str::random(7),
            "narration" => $payroll->title . "-paycirclex-bulk-payment",
            "sourceAccountNumber" => "7575544438",
            "onValidationFailure" => "CONTINUE",
            "notificationInterval" => 25,
            "transactionList"  => []
        ];
        foreach ($payees as $payee) {
            if ($payee->narration == '') {
                $narration = $payee->payroll->title . " paycirclex-payment";
            } else {
                $narration = $payee->narration;
            }
            $reference = "reference-" . $payee->uuid . Str::random(5);
            $payment_data['transactionList'][] = [
                "amount" => $payee->amount,
                "reference" => $reference,
                "narration" => $narration,
                "destinationBankCode" => $payee->bank_code,
                // "destinationBankCode" => '058',
                "destinationAccountName" => $payee->account_name,
                "destinationAccountNumber" => $payee->account_no,
                "currency" => "NGN"
            ];
            $payee->payment_reference = $reference;
            $payee->status = 2;
            $payee->save();
        }


        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $payment_response = Http::withHeaders($payment_headers)
            ->post(
                'https://sandbox.monnify.com/api/v2/disbursements/batch',
                $payment_data
            );
        $payroll->is_processed = 1;
        $payroll->process_count += 1;
        $payroll->save();
        $p_status = json_decode($payment_response, true);


        if ($p_status['requestSuccessful'] == true) {
            $user = Auth::user();
            $reference = $p_status['responseBody']['batchReference'];
            $amount = $p_status['responseBody']['totalAmount'] + $charges;
            $details = "Fund disburstment of " . $amount . " to the" . $payroll->title . " payroll";
            $this->create_transaction('Fund Disbursement', $reference, $details, 'debit', $amount, $user->id,1);
        } elseif ($p_status['requestSuccessful'] == false) {
            foreach ($payees as $payee) {
                $payee->status = 4;
                $payee->save();
            }
            $details = "Fund disburstment of falied for the" . $payroll->title . " payroll";
            $this->create_transaction('Fund Disbursement', 'failed-tranx', $details, 'debit', 0, $user->id,0);
        }
        $payroll = Payroll::where('uuid', $request->payroll_id)->with('payee')->first();


        return array($p_status, $payroll);
    }



    public function check_payment_status(Request $request)
    {

        //authentication to monnify
        //make the api call to make the transfer

        $access_token = $this->monnify_login_access_token();

        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $payment_response = Http::withHeaders($payment_headers)
            ->get('https://sandbox.monnify.com/api/v2/disbursements/transfer-status/' . $request->reference);

        $payee = Payee::where('payment_reference', $request->reference)->first();
        $status = json_decode($payment_response, true);

        if ($status['responseBody']['transactionStatus'] == 'SUCCESS') {
            $payee->status = 1;
        } elseif ($status['responseBody']['transactionStatus'] == 'PENDING') {
            $payee->status = 2;
        } else {
            $payee->status = 0;
        }
        $payee->save();
        return array($status, $payee);
    }
    public function check_payment_bulk_status(Request $request)
    {

        //authentication to monnify
        $access_token = $this->monnify_login_access_token();
        //make the api call to make the transfer
        $payroll = Payroll::where('uuid', $request->payroll_id)->first();
        $payees = Payee::where('payroll_id', $request->payroll_id)->where('status', '!=', 1)->get();
        $pay_status = 1;
        foreach ($payees as $payee) {
            if ($payee->status == 2) {

                $payment_headers = [
                    'Authorization' => 'Bearer ' . $access_token,
                ];
                $payment_response = Http::withHeaders($payment_headers)
                    ->get('https://sandbox.monnify.com/api/v2/disbursements/transfer-status/' . $payee->payment_reference);

                $payee = Payee::where('payment_reference', $payee->payment_reference)->first();
                $status = json_decode($payment_response, true);


                $pay_status = 1;
                if ($status['responseBody']['transactionStatus'] == 'SUCCESS') {
                    $payee->status = 1;
                } elseif ($status['responseBody']['transactionStatus'] == 'PENDING') {
                    $payee->status = 2;
                    $pay_status = 2;
                } else {
                    $payee->status = 0;
                }
                $payee->save();
            }
        }
        $payroll = Payroll::where('uuid', $request->payroll_id)->with('payee')->first();

        return array($pay_status, $payroll);
        // Check response status code

    }
    public function check_transaction_status(Request $request)
    {
        $transaction = Transaction::where('reference', $request->reference)->firstOrFail();
        if ($transaction->title == "Fund Disbursement") {
            $access_token = $this->monnify_login_access_token();
            // return $access_token;

            //make the api call to make the transfer



            $payment_headers = [
                'Authorization' => 'Bearer ' . $access_token,
            ];
            $payment_response = Http::withHeaders($payment_headers)
                ->get('https://sandbox.monnify.com/api/v2/disbursements/batch/summary?reference=' . $request->reference);
            $status = json_decode($payment_response, true);
            //    dd($status);
            if ($status['responseMessage'] == 'success') {
                $jsonData = json_encode($status, JSON_PRETTY_PRINT);
            } elseif ($status['responseBody']['transactionStatus'] == 'pending') {
                $jsonData = json_encode($status, JSON_PRETTY_PRINT);
            } else {
                $jsonData = 'Invalid/Unresolved transaction reference';
            }
            return redirect()->back()->with('reference', $jsonData);
        } else {
        }
    }
}
