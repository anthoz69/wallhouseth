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
            $table->string('name');
            $table->longText('address');
            $table->string('district');
            $table->string('amphoe');
            $table->string('province');
            $table->string('zipcode');
            $table->string('phone');
            $table->longText('bill_address')->nullable();
            $table->string('bill_district')->nullable();
            $table->string('bill_amphoe')->nullable();
            $table->string('bill_province')->nullable();
            $table->string('bill_zipcode')->nullable();
            $table->string('bill_phone')->nullable();
            $table->string('is_bill_same_address');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
