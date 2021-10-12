<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorders', function (Blueprint $table) {
            $table->id();
            $table->date('orderDate');
            $table->integer('customerNumber');
            $table->string('productCode',15);
            $table->integer('preorderQuantity');
            $table->string('checkNumber',50)->nullable();
            
            $table->foreign('productCode')->references('productCode')->on('products')->onUpdate('cascade');
            $table->foreign('customerNumber')->references('customerNumber')->on('customers');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preorders');
    }
}
