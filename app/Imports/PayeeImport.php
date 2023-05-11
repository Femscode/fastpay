<?php 
namespace App\Imports;

use App\Models\Bank;
use App\Models\FailedAccount;
use App\Models\User;
use App\Models\Payee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PayeeImport implements ToModel,WithHeadingRow
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function model(array $row)
    {
        $uuid = Str::uuid();
        // do the account verification here, if true proceed if not true, make the bank-code records failed
        $access_token = $this->monnify_login_access_token();

        $payment_headers = [
            'Authorization' => 'Bearer ' . $access_token,
        ];
        $account_number =  $row['account_no'] ?? $row['account_number'] ?? $row['account_no'] ?? $row['acct_no'] ?? $row['acct_no_of_beneficiaries'] ?? $row['beneficiary_account_no'] ?? $row['beneficiary_account_no'];
        //here some account number are actually 10 in number
        if(Str::length($account_number) < 10) {
            $account_number = "0".$account_number;
        }
        $bank_code = $this->getBankCode($row['bank_name'] ?? $row['bank_names'] ?? $row['bank'] ?? $row['name_of_bank'] ?? $row['names_of_banks'] ?? $row['name_of_banks']);
        // dd($row['account_no'],$bank_code,'ths');
        $confirm_response = Http::withHeaders($payment_headers)
            ->get(
                'https://sandbox.monnify.com/api/v1/disbursements/account/validate?accountNumber=' .$account_number . '&bankCode=' . $bank_code

            );
            $response = json_decode($confirm_response, true);
            

        if ($response['responseMessage'] == 'success') {

            if ( $row['amount'] < 10000) {
                $charges = 30;
            }
            elseif( $row['amount'] >= 10000 &&  $row['amount'] < 50000) {
                $charges = 50;
            }
            else {
                $charges = 90;
            }
        return new Payee([
            'payroll_id' => $this->data,
            'uuid' => $uuid,
            'account_name' => $row['account_name'] ?? $row['account_names'] ?? $row['acct_name'] ?? $row['names_of_beneficiaries'] ?? $row['name_of_beneficiary'] ?? $row['name'] ?? $row['beneficiary_name'],
            'account_no' => $account_number,
            'bank_name' => $row['bank_name'] ?? $row['bank_names'] ?? $row['bank'] ?? $row['name_of_bank'] ?? $row['names_of_banks'] ?? $row['name_of_banks'] ,
            'amount' => $row['amount'] ?? $row['amounts'] ?? $row['salary'] ?? $row['funds'],
            'narration' => $row['narration'] ?? $row['narrations'] ?? $row['transfer_narration'] ?? $row['money_narration'] ?? "",
            'bank_code' => $bank_code,
            'charges' => $charges
           
        ]);
    }
    else {
        FailedAccount::create([
            'payroll_id' => $this->data,
            'uuid' => $uuid,
            'account_name' => $row['account_name'] ?? $row['account_names'] ?? $row['acct_name'] ?? $row['names_of_beneficiaries'] ?? $row['name_of_beneficiary'] ?? $row['name'] ?? $row['beneficiary_name'],
            'account_no' => $account_number,
            'bank_name' => $row['bank_name'] ?? $row['bank_names'] ?? $row['bank'] ?? $row['name_of_bank'] ?? $row['names_of_banks'] ?? $row['name_of_banks'] ,
            'amount' => $row['amount'] ?? $row['amounts'] ?? $row['salary'] ?? $row['funds'],
            'narration' => $row['narration'] ?? $row['narrations'] ?? $row['transfer_narration'] ?? $row['money_narration'] ?? "",
            'bank_code' => $bank_code,
            
        ]);
        
    }
    }
    public function getBankCode($bank_slug) {
       
         
        $bank = Bank::where('slug', 'like' ,"%{$bank_slug}%")->first();
        if(empty($bank)) {
            return 0000;
        }
        else {
            return $bank->code;
        }

    }

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
}
?>