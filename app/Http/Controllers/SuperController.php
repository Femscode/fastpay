<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\User;
use App\Models\Cable;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperController extends Controller
{
    public function index()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['transactions'] = Transaction::where('title', 'Data Purchase')
            ->orWhere('title', 'Airtime Purchase')
            ->orWhere('title', 'Cable Subscription')
            ->orWhere('title', 'Electricity Payment')
            ->latest()->get();

        return view('super.index', $data);
    }
    public function notifications() {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['notification'] = Notification::find(1);

        return view('super.notifications', $data);

    }
    public function save_notifications(Request $request) {
        $this->validate($request, [
            'info' => 'required'
        ]);
        $notify = Notification::find(1);
        $notify->info = $request->info;
        $notify->save();
        return redirect()->back()->with('message', "Notification Updated Successfully!");
    }

    public function data_price() {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['datas'] = Data::latest()->get();

        return view('super.data_price', $data);
    }
    public function update_data(Request $request) {
        $data = Data::where('plan_id',$request->plan_id)->firstOrFail();
        $data->plan_name = $request->plan_name;
        $data->actual_price = $request->actual_price;
        $data->data_price = $request->data_price;
        $data->save();
        return true;
    }

    public function cable_price() {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['cables'] = Cable::latest()->get();

        return view('super.cable_price', $data);
    }
    public function update_cable(Request $request) {
        $cable = Cable::where('plan_id',$request->plan_id)->firstOrFail();
        $cable->plan_name = $request->plan_name;
        $cable->actual_price = $request->actual_price;
        $cable->real_price = $request->real_price;
        $cable->save();
        return true;
    }
    public function payment_transactions()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';
        $data['payments'] = Transaction::where('title', 'Account Funding')
            ->orWhere('title', 'Fund Transfer')
            ->orWhere('title', 'Payment Received')
            ->orWhere('title', 'Funds Withdraw')
            ->latest()->get();
        return view('super.payment_transactions', $data);
    }
    public function user_management()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com') {
            return redirect()->route('dashboard');
        }
        $data['users'] = User::latest()->get();
        $data['active'] = 'super';

        return view('super.user_management', $data);
    }
    public function user_transaction($id)
    {
        $data['user'] =  $user = User::where('uuid', $id)->first();
        // dd($user);

        $data['transactions'] = Transaction::where('user_id', $user->id)
            // ->where('title', 'Data Purchase')
            // ->orWhere('title', 'Airtime Purchase')
            // ->orWhere('title', 'Cable Subscription')
            // ->orWhere('title', 'Electricity Payment')
            ->latest()->get();
        $data['active'] = 'super';

        return view('super.index', $data);
    }
    public function block_user($id)
    {
        $data['user'] =  $user = User::where('uuid', $id)->first();

        if ($user) {
            if ($user->block == 1) {
                $user->block = 0;
                $user->save();
                return redirect()->back()->with('message', "User Unblocked Successfully!");
            } else {
                $user->block = 1;
                $user->save();
                return redirect()->back()->with('message', "User Blocked Successfully!");
            }
        }
    }
}
