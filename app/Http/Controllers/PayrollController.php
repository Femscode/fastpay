<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Payee;
use App\Models\Payroll;
use Illuminate\Support\Str;
use App\Imports\PayeeImport;
use App\Models\FailedAccount;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Response as RR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class PayrollController extends Controller
{
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
    public function add_new_payroll(Request $request)
    {
        $user = Auth::user();
        $uuid = Str::uuid();
        Payroll::create(['title' => $request->title, 'uuid' => $uuid, 'user_id' => $user->uuid]);
        return redirect()->back()->with('message', 'New Payroll Added!');
    }
    public function manual_add_payee(Request $request)
    {

        $this->validate($request, [
            "account_name" => "required",
            "account_no" => "required",
            "bank_name" => "required",
            'bank_code' => 'required',
            "amount" => "required",
            "payroll_id" => "required"
        ]);

        $access_token = $this->monnify_login_access_token();
        // return $access_token;

        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $confirm_response = Http::withHeaders($payment_headers)
            ->get(
                'https://sandbox.monnify.com/api/v1/disbursements/account/validate?accountNumber=' . $request->account_no . '&bankCode=' . $request->bank_code

            );



        if ($confirm_response['responseMessage'] == 'success') {
            $data = $request->all();
            $data['uuid'] = Str::uuid();
            if ($data['amount'] < 10000) {
                $data['charges'] = 30;
            } elseif ($data['amount'] >= 10000 && $data['amount'] < 50000) {
                $data['charges'] = 50;
            } else {
                $data['charges'] = 90;
            }
            $payee = Payee::create($data);
            return $payee;
        } else {
            return "account-not-found";
        }


        // dd($request->all());


    }
    public function sample_import_data()
    {

        $path = public_path('import-data-sample.xls');
        $fileName = 'import-data-sample.xls';

        return RR::download($path, $fileName);
    }
    public function live_add(Request $request)
    {

        $payroll = Payroll::where('uuid', $request->payroll_id)->first();
        $this->validate($request, [
            "account_name" => "required",
            "account_no" => "required",
            "bank_code" => "required",
            "payroll_id" => "required"
        ]);
        // dd($request->all());
        $bank_name = Bank::where('code', $request->bank_code)->first();

        $data = $request->all();
        $data['uuid'] = Str::uuid();
        $data['bank_name'] = $bank_name->name;


        $access_token = $this->monnify_login_access_token();
        // return $access_token;

        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $confirm_response = Http::withHeaders($payment_headers)
            ->get(
                'https://sandbox.monnify.com/api/v1/disbursements/account/validate?accountNumber=' . $request->account_no . '&bankCode=' . $request->bank_code

            );



        if ($confirm_response['responseMessage'] == 'success') {

            $payee = Payee::create($data);
            //initiate a session here that last for a day

            $session_value =  'live_add' . $payroll->title;

            session()->put($session_value, 'value', 60 * 24);
            return redirect()->back()->with('message', 'Account Details Added Successfully!');
        } else {
            return redirect()->back()->with('error', 'Invalid Account Details!');
        }
    }
    public function import_add_payee(Request $request)
    {
        $this->validate($request, ['file' => 'required', 'payroll_id' => 'required']);
        $file = $request->file('file');
        $excel = Excel::import(new PayeeImport($request->payroll_id), $file);

        return true;
    }
    public function failed_account($id)
    {
        $data['failed'] = FailedAccount::where('payroll_id', $id)->get();
        $data['payroll'] = Payroll::where('uuid', $id)->first();
        $data['user'] = $user = Auth::user();
        $data['banks'] = Bank::orderBy('name')->get();

        return view('dashboard.failed_account', $data);
    }
    public function check_failed_account(Request $request)
    {

        $data = FailedAccount::where('payroll_id', $request->payroll_id)->get();
        if ($data->isEmpty()) {
            return 0;
        } else {
            return 1;
        }
    }
    public function update_payee(Request $request)
    {

        $payee = Payee::where('uuid', $request->payee_id)->first();
        $payee->account_name = $request->account_name;
        $payee->account_no = $request->account_no;
        $payee->bank_name = $request->bank_name;
        $payee->bank_code = $request->bank_code;
        $payee->amount = $request->amount;
        if ($request->amount < 10000) {
            $charges = 30;
        } elseif ($request->amount >= 10000 &&  $request->amount < 50000) {
            $charges = 50;
        } else {
            $charges = 90;
        }
        $payee->charges = $charges;
        $payee->save();
        return $payee;
    }
    public function update_payroll_title(Request $request)
    {
        $user = Auth::user();
        $payroll = Payroll::where('uuid', $request->payroll_id)->first();
        $payroll->title = $request->title;
        $payroll->save();
        $payrolls = Payroll::where('user_id', $user->uuid)->with('payee')->latest()->get();
        return $payrolls;
    }
    public function change_payroll_charge($id)
    {
        $payroll = Payroll::where('uuid', $id)->first();
        $payees = Payee::where('payroll_id', $id)->get();
        if ($payroll->user_charge == 'payroll') {
            foreach ($payees as $payee) {
                if($payee->charges_count == 0) {
                    $payee->amount -= $payee->charges;
                    $payee->save();
                }
                
            }
            $payroll->user_charge = 'payee';
            $payroll->save();
        } else {
            foreach ($payees as $payee) {
                if($payee->charges_count == 0) {
                $payee->amount += $payee->charges;
                $payee->save();
                }
            }

            $payroll->user_charge = 'payroll';
            $payroll->save();
        }
        $payroll = Payroll::where('uuid', $id)->with('payee')->first();
        return $payroll;
    }
    public function update_failed_account(Request $request)
    {
        //    dd($request->all());

        $payroll = Payroll::where('uuid', $request->payroll_id)->first();
        $this->validate($request, [
            "account_name" => "required",
            "account_no" => "required",
            "bank_code" => "required",
            "payroll_id" => "required"
        ]);
        // dd($request->all());
        $bank_name = Bank::where('code', $request->bank_code)->first();

        $data = $request->all();
        $data['uuid'] = Str::uuid();
        $data['bank_name'] = $bank_name->name;


        $access_token = $this->monnify_login_access_token();
        // return $access_token;

        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $confirm_response = Http::withHeaders($payment_headers)
            ->get(
                'https://sandbox.monnify.com/api/v1/disbursements/account/validate?accountNumber=' . $request->account_no . '&bankCode=' . $request->bank_code

            );



        if ($confirm_response['responseMessage'] == 'success') {
            if ($request->amount < 10000) {
                $charges = 30;
            } elseif ($request->amount >= 10000 &&  $request->amount < 50000) {
                $charges = 50;
            } else {
                $charges = 90;
            }
            $data['charges'] = $charges;
            unset($data['id']);

            $payee = Payee::create($data);
            $failedAccount = FailedAccount::find($request->id)->delete();
            return true;
        } else {
            return false;
        }
    }
    public function delete_payee($uuid)
    {
        $payee = Payee::where('uuid', $uuid)->delete();
        return true;
    }
    public function delete_payroll($uuid)
    {
        Payee::where('payroll_id', $uuid)->delete();
        Payroll::where('uuid', $uuid)->delete();
        return true;
    }
    public function change_payroll($uuid)
    {
        $user = Auth::user();
        $payroll = Payroll::where('uuid', $uuid)->with('payee')->first();

        return $payroll;
    }
    public function reset_payroll(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $pin = $request->pin;
        $hashed_pin = hash('sha256', $pin);
        if ($user->pin !== $hashed_pin) {
            return "Invalid Pin";
        }
        $payroll = Payroll::where('uuid', $request->payroll_id)->with('payee')->first();
        $payroll->is_processed = 0;
        $payroll->save();
        $payees = Payee::where('payroll_id', $payroll->uuid)->update([
            'status' => 4,
            'pay_status' => 1,
            'payment_reference' => null
        ]);

        $payroll = Payroll::where('uuid', $request->payroll_id)->with('payee')->first();


        return $payroll;
    }
    public function pick_first($uuid, $number)
    {

        $user = Auth::user();
        $all_payee =  Payee::where('payroll_id', $uuid)->update(['pay_status' => 0]);
        $payee = Payee::where('payroll_id', $uuid)->take($number)->get();
        foreach ($payee as $pp) {
            $pp->pay_status = 1;
            $pp->save();
        }
        return $payee;
    }


    public function live_toggle($id)
    {
        $payroll = Payroll::where('uuid', $id)->with('payee')->first();
        if ($payroll->live == 0) {
            $payroll->live = 1;
        } else {
            $payroll->live = 0;
        }
        $payroll->save();
        return $payroll;
    }

    public function change_payment_status(Request $request)
    {
        $payee = Payee::where('uuid', $request->payee_id)->first();
        if ($payee->pay_status == 0) {
            $payee->pay_status = 1;
        } else {
            $payee->pay_status = 0;
        }
        $payee->save();
        return $payee;
    }
    public function slug($slug)
    {
        // dd(Session::all());
        $data['payroll'] = $payroll = Payroll::where('uuid', $slug)->firstOrFail();
        $data['banks'] = Bank::orderBy('name')->get();
        if ($payroll->live == 0) {
            return redirect()->route('home');
        } else {
            return view('frontend.live_link', $data);
        }
    }
}
