<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_order')->nullable();
            $table->double('payment_amount')->nullable();
            $table->double('remaining_payment')->nullable();
            $table->string('type_payment', 50)->nullable();
            $table->string('proof_payment')->nullable();
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
        Schema::dropIfExists('tbl_order_payments');
    }
}
