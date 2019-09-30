<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductT extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_product');
        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedInteger('product');
            $table->unsignedInteger('order');
            $table->unsignedInteger('quantity');
            $table->primary(['product', 'order']);
            $table->foreign('product')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('order')->references('id')->on('order')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
