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
            $table->string('tracking')->nullable()->index();
            $table->string('ref')->unique();
            $table->string('status');
            $table->string('payment_status');
            $table->longText('payment_detail')->nullable();
            $table->string('shippop_ref')->nullable();
            $table->longText('shippop_detail')->nullable();
            $table->string('courier_code')->nullable();
            $table->unsignedDecimal('courier_price')->default(0);
            $table->string('bill_name')->nullable();
            $table->string('bill_phone')->nullable();
            $table->string('bill_country')->nullable();
            $table->string('bill_address')->nullable();
            $table->string('bill_amphoe')->nullable();
            $table->string('bill_district')->nullable();
            $table->string('bill_province')->nullable();
            $table->string('bill_zipcode')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_amphoe')->nullable();
            $table->string('shipping_district')->nullable();
            $table->string('shipping_province')->nullable();
            $table->string('shipping_zipcode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
