<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnPriceToPricePerdayTblCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cars', function (Blueprint $table) {
            $table->renameColumn('price', 'price_perday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_cars', function (Blueprint $table) {
            $table->renameColumn('price_perday', 'price');
        });
    }
}
