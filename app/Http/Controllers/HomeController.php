<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Payroll;
use App\Models\MySession;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\TransactionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    use TransactionTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function logout()
    {
        Auth::logout();
        // return Redirect::route('login');
        Session::flush();

        return Redirect::away('login');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }
    public function setpin(Request $request)
    {
        $this->validate($request, [
            'first' => 'required',
            'second' => 'required',
            'third' => 'required',
            'first' => 'required',
            'user_id' => 'required'
        ]);
        $pin = $request->first . $request->second . $request->third . $request->fourth;

        $hashed_pin = hash('sha256', $pin);

        $user = User::where('uuid', $request->user_id)->firstOrFail();
        $user->pin = $hashed_pin;
        $user->save();
        return true;
    }
    public function dashboard()
    {
        $data['user'] = $user = Auth::user();
        // dd($user);
        $data['active'] = 'dashboard';
        if ($user->block == 1) {
            return view('dashboard.unverified', $data);
        }
        if ($user->pin == null) {
            return view('dashboard.setpin', $data);
        } else {

            if ($user->user_type == 'user') {

                $data['current_payroll'] = $current_payroll =  Payroll::where('user_id', $user->uuid)->with('payee')->latest()->first();
                $data['payrolls'] = $payroll =  Payroll::where('user_id', $user->uuid)->with('payee')->latest()->get();
                $data['banks'] = Bank::all();
                return view('dashboard.index', $data);
            } else {
                return view('dashboard.index', $data);
                dd("The Admin/Vendor Page");
            }
        }
    }
    public function saved_orders()
    {
        $data['user'] = $user = Auth::user();
        $data['active'] = 'dashboard';
        $data['sessions'] = MySession::where('email', $user->email)->latest()->get();

        return view('dashboard.saved_order', $data);
    }
    public function delete_order(Request $request)
    {
        $session = MySession::find($request->id);
        $session->delete();
        return true;
    }
    public function profile()
    {
        $data['user'] = Auth::user();
        $data['active'] = 'profile';
        return view('dashboard.profile', $data);
    }
    public function process_order(Request $request)
    {
        $response = Http::post(env('SECOND_APP') . '/api/process_order', [
            'order_id' => $request->order_id,

        ]);
        return $response;

        dd($request->all());
    }
    public function resend_verification()
    {
        $auth_user = Auth::user();
        $user = User::where('id', $auth_user->id)->first();
        if ($user->email_resend <= 3) {
            $user->email_resend += 1;
            $user->save();
            $user->sendEmailVerificationNotification();
            return redirect()->back()->with('message', 'Verification mail sent successfully!');
        } else {
            return redirect()->back()->with('message', 'Maximum amount of time to resend email reached!');
        }
    }
    public function fundwallet()
    {

        $data['user'] = $user = Auth::user();
        $data['active'] = 'fundwallet';

        if ($user->account_no == null) {
            $reserve = $this->reserve_account_paystack();
        }
        return view('dashboard.fundwallet', $data);
    }
    public function withdraw()
    {

        $data['user'] = $user = Auth::user();
        $data['active'] = 'fundwallet';


        return view('dashboard.withdraw', $data);
    }
    public function confirm_account(Request $request)
    {
        // dd($request->all());
        $url = "https://api.paystack.co/transferrecipient";

        $fields = [
            'type' => "nuban",
            'name' => "",
            'account_number' => $request->account_no,
            'bank_code' => $request->bank_code,
            'currency' => "NGN"
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
        $res_json = json_decode($result, true);
        if ($res_json['status'] == true) {
            return $res_json;
        }
        return false;
        dd($res_json);
    }
    public function make_transfer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);
        $user = Auth::user();
        $user_pin = $request->first . $request->second . $request->third . $request->fourth;

        $hashed_pin = hash('sha256', $user_pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Pin',

            ];

            return response()->json($response);
        }
        $url = "https://api.paystack.co/transfer";
        $reference = 'my-unique-reference-' . strtolower(preg_replace('/[0-9]/', '', Str::random(3)));
        $amount = ($request->amount * 100) + 100;
        //the pin validation here;

        if ($user->balance < $request->amount + 100) {
            $response = [
                'success' => false,
                'message' => 'Insufficient Balance',
               
            ];
        
            return response()->json($response);
          
        }
        $fields = [
            'source' => "balance",
            'amount' => $amount - 100,
            "reference" => $reference,
            'recipient' => $request->recipient_code,
            'reason' => "CT_TASTE VENDOR PAYOUT"
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
        echo $result;
        $res_json = json_decode($result, true);

        if ($res_json['status'] == true) {
            $details = "Withdraw of NGN " . $request->amount . " to " . $request->account_name;
            $this->create_transaction('Funds Withdraw', $reference, $details, 'debit', $request->amount + 100, $user->id, 1);

            $user->balance -= $request->amount + 100;
            $user->save();

            return $res_json;
        } else {
            $details = "Failed Withdraw of NGN " . $request->amount . " to " . $request->account_name;
            $this->create_transaction('Funds Withdraw', $reference, $details, 'debit', $request->amount + 100, $user->id, 0);

            $user->balance -= $request->amount + 100;
            $user->save();

            return $res_json;
        }
        return false;
        dd($res_json);
    }
    public function transactions()
    {
        $data['user'] = $user = Auth::user();
        $data['active'] = 'transaction';
        $data['transactions'] = Transaction::where('user_id', $user->id)->latest()->get();


        return view('dashboard.transactions', $data);
    }
    public function updateprofile(Request $request)
    {

        $user = Auth::user();
        if ($request->image !== null) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('profile_picture'), $imageName);
            $user->image = $imageName;
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->back()->with('message', 'User Profile Updated Successfully!');
    }
}
