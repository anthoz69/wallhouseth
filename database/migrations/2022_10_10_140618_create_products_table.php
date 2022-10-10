<?php

use App\Enums\ProductStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
            $table->decimal('price', 13, 2)->default(0);
            $table->string('name', 255);
            $table->unsignedBigInteger('stock_available')->default(0);
            $table->json('attributes');
            $table->string('main_image', 255);
            $table->json('other_image');
            $table->string('status')->default(ProductStatus::WaitForTranslate)->index();
            $table->json('original_data');
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
