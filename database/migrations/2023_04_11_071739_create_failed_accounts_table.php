<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('payroll_id');
            $table->string('uuid');
            $table->string('account_name');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('amount');
            $table->string('narration')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('charges')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_accounts');
    }
}
