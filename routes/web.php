<?php

use App\Models\Data;
use App\Models\User;
use App\Models\Cable;
use App\Models\Payee;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginWithGoogleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Auth::routes();
Route::view('/','coming_soon');
Route::any('/notify', [App\Http\Controllers\SubscriptionController::class, 'notify'])->name('notify');
// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');
// Route::any('addfee', function () {
//     $datas = Cable::all();
//     foreach ($datas as $data) {
//         $data->real_price = $data->actual_price + (0.1 * $data->actual_price);
//         $data->save();
//     }
//     return 'fee added';
// });
// Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
// Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');
// Route::any('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
// Route::get('/sample_import_data', [App\Http\Controllers\PayrollController::class, 'sample_import_data'])->name('sample_import_data');

// Route::group(['middleware' => 'auth'], function () {

//     Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
//     Route::get('/saved_orders', [App\Http\Controllers\HomeController::class, 'saved_orders'])->name('saved_orders');
//     Route::post('/process_order', [App\Http\Controllers\HomeController::class, 'process_order'])->name('process_order');
//     Route::get('/delete_order', [App\Http\Controllers\HomeController::class, 'delete_order'])->name('delete_order');
//     Route::post('/updateprofile', [App\Http\Controllers\HomeController::class, 'updateprofile'])->name('updateprofile');
//     Route::post('/setpin', [App\Http\Controllers\HomeController::class, 'setpin'])->name('setpin');
//     Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
//     Route::get('fundwallet', [App\Http\Controllers\HomeController::class, 'fundwallet'])->name('fundwallet');
//     Route::get('withdraw', [App\Http\Controllers\HomeController::class, 'withdraw'])->name('withdraw');
//     Route::any('confirm_account', [HomeController::class, 'confirm_account'])->name('confirm_account');
//     Route::any('make_transfer', [HomeController::class, 'make_transfer'])->name('make_transfer');

//     Route::get('resend_verification', [App\Http\Controllers\HomeController::class, 'resend_verification'])->name('resend_verification');
//     Route::get('transactions', [App\Http\Controllers\HomeController::class, 'transactions'])->name('transactions');
//     Route::get('transfer', [App\Http\Controllers\FundingController::class, 'transfer'])->name('transfer');
//     Route::get('pay_cttaste/{slug}', [App\Http\Controllers\FundingController::class, 'pay_cttaste'])->name('pay_cttaste');
//     // Route::post('make_transfer', [App\Http\Controllers\FundingController::class, 'make_transfer'])->name('make_transfer');
//     Route::post('pay_for_order', [App\Http\Controllers\FundingController::class, 'pay_for_order'])->name('pay_for_order');
//     Route::post('verify_id', [App\Http\Controllers\FundingController::class, 'verify_id'])->name('verify_id');
//     Route::post('verify_order', [App\Http\Controllers\FundingController::class, 'verify_order'])->name('verify_order');
//     Route::post('/pay', [App\Http\Controllers\FundingController::class, 'redirectToGateway'])->name('pay');
//     Route::get('/payment/callback', [App\Http\Controllers\FundingController::class, 'handleGatewayCallback']);
//     Route::get('/reserve_account', [App\Http\Controllers\FundingController::class, 'reserve_account']);
//     Route::post('monnify/transaction_complete', [App\Http\Controllers\MonnifyController::class, 'monnifyTransactionComplete2']);
//     //subscription routes
//     Route::get('/data', [App\Http\Controllers\SubscriptionController::class, 'data']);
//     Route::get('/airtime', [App\Http\Controllers\SubscriptionController::class, 'airtime']);
//     Route::get('/electricity', [App\Http\Controllers\SubscriptionController::class, 'electricity']);
//     Route::get('/cable', [App\Http\Controllers\SubscriptionController::class, 'cable']);
//     Route::post('/buydata', [App\Http\Controllers\SubscriptionController::class, 'buydata']);
//     Route::post('/buyairtime', [App\Http\Controllers\SubscriptionController::class, 'buyairtime']);
//     Route::post('/buyCable', [App\Http\Controllers\SubscriptionController::class, 'buyCable']);
//     Route::post('/buyElectricity', [App\Http\Controllers\SubscriptionController::class, 'buyElectricity']);
//     Route::get('/fetchnetwork/{phone}', [App\Http\Controllers\SubscriptionController::class, 'fetchnetwork']);
//     Route::get('/fetchplan/{network}', [App\Http\Controllers\SubscriptionController::class, 'fetchplan']);
//     Route::get('/fetchdiscount/{network}', [App\Http\Controllers\SubscriptionController::class, 'fetchdiscount']);
//     Route::get('/fetch_cable_plan/{network}', [App\Http\Controllers\SubscriptionController::class, 'fetch_cable_plan']);
//     Route::post('/fetch_meter_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_meter_details']);
//     Route::post('/fetch_decoder_details', [App\Http\Controllers\SubscriptionController::class, 'fetch_decoder_details']);
// });

// Route::post('/live_add', [App\Http\Controllers\PayrollController::class, 'live_add'])->name('live_add');
// // Payrll and payee 
// Route::get('/support', [App\Http\Controllers\HomeController::class, 'support'])->name('support');
// Route::group(['middleware' => 'auth'], function () {
//     Route::any('/superadmin', [App\Http\Controllers\SuperController::class, 'index'])->name('superadmin');
//     Route::any('/payment_transactions', [App\Http\Controllers\SuperController::class, 'payment_transactions'])->name('payment_transactions');
//     Route::any('/user_management', [App\Http\Controllers\SuperController::class, 'user_management'])->name('user_management');
//     Route::any('/user_transaction/{id}', [App\Http\Controllers\SuperController::class, 'user_transaction'])->name('user_transaction');
//     Route::any('/block_user/{id}', [App\Http\Controllers\SuperController::class, 'block_user'])->name('block_user');
// });
// Route::group(['middleware' => 'auth'], function () {
//     //new routes
//     Route::any('/resetpassword', [App\Http\Controllers\UserController::class, 'resetpassword'])->name('resetpassword');
//     Route::any('/change-password', [App\Http\Controllers\UserController::class, 'changepassword'])->name('change-password');
//     Route::any('/resetpin', [App\Http\Controllers\UserController::class, 'resetpin'])->name('resetpin');
//     Route::any('/change-pin', [App\Http\Controllers\UserController::class, 'changepin'])->name('change-pin');
//     Route::any('/forgot-pin', [App\Http\Controllers\UserController::class, 'forgotpin'])->name('forgot-pin');
//     Route::any('/reset-pin-with-token', [App\Http\Controllers\UserController::class, 'resetPinWithToken'])->name('reset-pin-with-token');
//     Route::any('/reset-forgot-pin', [App\Http\Controllers\UserController::class, 'resetforgotpin'])->name('reset-forgot-pin');
//     Route::any('/print_transaction_receipt/{id}', [App\Http\Controllers\UserController::class, 'print_transaction_receipt'])->name('print_transaction_receipt');


//     Route::post('/add_new_payroll', [App\Http\Controllers\PayrollController::class, 'add_new_payroll'])->name('add_new_payroll');
//     Route::post('/add_new_payroll', [App\Http\Controllers\PayrollController::class, 'add_new_payroll'])->name('add_new_payroll');
//     Route::post('/manual_add_payee', [App\Http\Controllers\PayrollController::class, 'manual_add_payee'])->name('manual_add_payee');
//     Route::post('/import_add_payee', [App\Http\Controllers\PayrollController::class, 'import_add_payee'])->name('import_add_payee');
//     Route::post('/update_payee', [App\Http\Controllers\PayrollController::class, 'update_payee'])->name('update_payee');
//     Route::delete('/delete_payee/{id}', [App\Http\Controllers\PayrollController::class, 'delete_payee'])->name('delete_payee');
//     Route::delete('/delete_payroll/{id}', [App\Http\Controllers\PayrollController::class, 'delete_payroll'])->name('delete_payroll');
//     Route::get('/change_payroll/{id}', [App\Http\Controllers\PayrollController::class, 'change_payroll'])->name('change_payroll');
//     Route::post('/update_payroll_title', [App\Http\Controllers\PayrollController::class, 'update_payroll_title'])->name('update_payroll_title');
//     Route::post('/reset_payroll', [App\Http\Controllers\PayrollController::class, 'reset_payroll'])->name('reset_payroll');
//     Route::get('/live_toggle/{id}', [App\Http\Controllers\PayrollController::class, 'live_toggle'])->name('live_toggle');
//     Route::get('/pick_first/{uuid}/{id}', [App\Http\Controllers\PayrollController::class, 'pick_first'])->name('pick_first');
//     Route::post('/change_payment_status', [App\Http\Controllers\PayrollController::class, 'change_payment_status'])->name('change_payment_status');
//     Route::get('/change_payroll_charge/{id}', [App\Http\Controllers\PayrollController::class, 'change_payroll_charge'])->name('change_payroll_charge');
//     Route::get('/failed_account/{id}', [App\Http\Controllers\PayrollController::class, 'failed_account'])->name('failed_account');
//     Route::post('/check_failed_account', [App\Http\Controllers\PayrollController::class, 'check_failed_account'])->name('check_failed_account');
//     Route::post('/update_failed_account', [App\Http\Controllers\PayrollController::class, 'update_failed_account'])->name('update_failed_account');

//     // payment initialization
//     Route::post('/initialize_payment/', [App\Http\Controllers\PaymentController::class, 'initialize_payment'])->name('initialize_payment');
//     Route::post('/check_payment_bulk_status/', [App\Http\Controllers\PaymentController::class, 'check_payment_bulk_status'])->name('check_payment_bulk_status');
//     Route::post('/check_payment_status/', [App\Http\Controllers\PaymentController::class, 'check_payment_status'])->name('check_payment_status');
//     Route::post('/check_transaction_status/', [App\Http\Controllers\PaymentController::class, 'check_transaction_status'])->name('check_transaction_status');
// });
// // Email Verification Routes...
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware(['auth'])->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('status', 'verification-link-sent');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Route::get('{slug}', [App\Http\Controllers\FundingController::class, 'pay_cttaste'])->name('pay_cttaste')->middleware('auth');
