<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTblCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cars', function (Blueprint $table) {
            $table->integer('id_branch')->after('address');
            $table->integer('price')->after('id_branch');
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
            $table->dropColumn('id_branch');
            $table->dropColumn('price');
        });
    }
}
