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
            $table->string('product', 10);
            $table->unsignedInteger('order');
            $table->unsignedInteger('quantity');
            $table->primary(['product', 'order']);
            $table->foreign('order')->references('id')->on('order')->onDelete('cascade');
            $table->foreign('product')->references('sku')->on('product')->onDelete('cascade');
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
