<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomePriceColumnTblCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cars', function (Blueprint $table) {
            $table->string('price_permonth')->nullable()->after('id_branch');
            $table->string('price_perweek')->nullable()->after('price_permonth');
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
            $table->dropColumn('price_permonth');
            $table->dropColumn('price_perweek');
        });
    }
}
