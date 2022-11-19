<?php

use App\Enums\ProductStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 255)->unique();
            $table->string('barcode', 150)->index()->nullable();
            $table->string('name', 255);
            $table->decimal('price', 13, 2)->default(0);
            $table->unsignedBigInteger('stock_available')->default(0);
            $table->json('attributes')->nullable();
            $table->string('main_image', 255)->nullable();
            $table->json('other_image')->nullable();
            $table->decimal('width')->default(0);
            $table->decimal('length')->default(0);
            $table->decimal('height')->default(0);
            $table->decimal('kg')->default(0);
            $table->string('status')->default(ProductStatus::WaitForTranslate)->index();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->json('original_data')->nullable();
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
        Schema::dropIfExists('products');
    }
};
