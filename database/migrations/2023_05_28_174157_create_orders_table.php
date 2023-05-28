<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('cart')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->decimal('delivery_amount')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
