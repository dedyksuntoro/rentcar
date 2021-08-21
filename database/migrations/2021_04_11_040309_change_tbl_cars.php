<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTblCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_cars', function (Blueprint $table) {
            $table->integer('id_manufacturer')->nullable()->change();
            $table->integer('id_brand')->nullable()->change();
            $table->integer('year')->nullable()->change();
            $table->string('chassis_number')->nullable()->change();
            $table->string('engine_number')->nullable()->change();
            $table->string('registration_number', 25)->nullable()->change();
            $table->string('owner', 50)->nullable()->change();
            $table->text('address')->nullable()->change();
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
