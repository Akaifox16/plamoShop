<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdershippedaddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordershippedaddress', function (Blueprint $table) {
            $table->integer('orderNumber')->primary();
            $table->string('addressLine1',50);
            $table->string('addressLine2',50);
            $table->string('city',50);
            $table->string('state',50);
            $table->string('postalCode',15);
            $table->string('country',50);

            $table->foreign('orderNumber')->references('orderNumber')->on('orders')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordershippedaddress');
    }
}
