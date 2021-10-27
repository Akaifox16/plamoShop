<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropConstraintProductsTable extends Migration
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
        });

        
        Schema::table('preorders', function (Blueprint $table) {
            $table->dropForeign("preorders_productcode_foreign");
        });

        
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->dropForeign("orderdetails_productcode_foreign");
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
