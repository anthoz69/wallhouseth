<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('is_main')->default(2);
            $table->string('name');
            $table->string('bill_name')->nullable();
            $table->string('bill_phone')->nullable();
            $table->string('bill_country')->nullable();
            $table->string('bill_address')->nullable();
            $table->string('bill_district')->nullable();
            $table->string('bill_amphoe')->nullable();
            $table->string('bill_province')->nullable();
            $table->string('bill_zipcode')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_district')->nullable();
            $table->string('shipping_amphoe')->nullable();
            $table->string('shipping_province')->nullable();
            $table->string('shipping_zipcode')->nullable();
            $table->string('is_bill_same_address')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
