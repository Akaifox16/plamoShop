<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditConstraintProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_ins', function (Blueprint $table) {
            $table->dropForeign("stock_ins_productcode_foreign");
            $table->foreign('productCode')->references('productCode')->on('products')->onDelete('no action')->onUpdate('cascade');
        });

        
        Schema::table('preorders', function (Blueprint $table) {
            $table->dropForeign("preorders_productcode_foreign");
            $table->foreign('productCode')->references('productCode')->on('products')->onDelete('no action')->onUpdate('cascade');
        });

        
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->dropForeign("orderdetails_ibfk_2");
            $table->foreign('productCode')->references('productCode')->on('products')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
