<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->unique();
            $table->string('barcode')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('price', 15, 2);
            $table->decimal('discount', 15, 2)->default(0);
            $table->integer('stock_available')->default(0)->nullable();
            $table->longText('features')->nullable();
            $table->float('width', 15, 2)->default(0)->nullable();
            $table->float('length', 15, 2)->default(0)->nullable();
            $table->float('height', 15, 2)->default(0)->nullable();
            $table->float('kg', 15, 2)->default(0)->nullable();
            $table->string('status');
            $table->longText('original_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
