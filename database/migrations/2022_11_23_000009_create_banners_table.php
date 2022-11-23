<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('enable');
            $table->integer('sort');
            $table->string('url')->nullable();
            $table->string('new_tab');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
