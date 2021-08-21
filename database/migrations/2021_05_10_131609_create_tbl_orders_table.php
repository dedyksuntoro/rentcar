<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number')->nullable();
            $table->integer('id_customer')->nullable();
            $table->integer('id_car')->nullable();
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->integer('total_days')->nullable();
            $table->double('total')->nullable();
            $table->string('pay_status')->nullable();
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
        Schema::dropIfExists('tbl_orders');
    }
}
