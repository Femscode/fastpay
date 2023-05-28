<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMySessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('rest_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('session')->nullable();
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
        Schema::dropIfExists('my_sessions');
    }
}
