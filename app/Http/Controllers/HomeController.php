<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Payroll;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\TransactionTrait;
use Illuminate\Support\Facades\Auth;
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
        if ($user->email_verified_at == null) {
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
    public function profile()
    {
        $data['user'] = Auth::user();
        return view('dashboard.profile', $data);
    }
    public function resend_verification() {
        $auth_user = Auth::user();
        $user = User::where('id',$auth_user->id)->first();
        if($user->email_resend <= 3) {
            $user->email_resend += 1;
            $user->save();
            $user->sendEmailVerificationNotification();
            return redirect()->back()->with('message','Verification mail sent successfully!');
        }
        else {
            return redirect()->back()->with('message','Maximum amount of time to resend email reached!');
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
