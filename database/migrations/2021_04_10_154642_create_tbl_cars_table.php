<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cars', function (Blueprint $table) {
            $table->id();
            $table->integer('id_manufacturer');
            $table->integer('id_brand');
            $table->year('year');
            $table->year('chassis_number');
            $table->year('engine_number');
            $table->string('registration_number');
            $table->string('owner');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cars');
    }
}
