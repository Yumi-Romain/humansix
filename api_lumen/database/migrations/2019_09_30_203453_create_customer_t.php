<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerT extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('customer');
        Schema::create('customer', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement(); // primary key
            $table->string('firstname', 150);
            $table->string('lastname', 150);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
