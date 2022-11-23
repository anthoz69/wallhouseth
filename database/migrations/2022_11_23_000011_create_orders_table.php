<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref')->unique();
            $table->string('status');
            $table->string('payment_status');
            $table->longText('payment_detail')->nullable();
            $table->string('shippop_ref')->nullable();
            $table->longText('shippop_detail')->nullable();
            $table->string('tracking')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
