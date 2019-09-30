<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductT extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product');
        Schema::create('product', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement(); // primary key
            $table->string('name', 150);
            $table->decimal('price', 10, 2); // price XXXXXXXX,XX
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
