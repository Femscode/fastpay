<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SuperController extends Controller
{
    public function superadmin() {
        $data['users'] = User::latest()->get();
        $data['transactions'] = Transaction::latest()->get();
    }
}
