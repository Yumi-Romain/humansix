<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderT extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order');
        Schema::create('order', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement(); // primary key
            $table->dateTime('orderDate');
            $table->string('status', 150);
            $table->unsignedInteger('customer');
            $table->foreign('customer')->references('id')->on('customer')->onDelete('no action'); // foreign key
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
