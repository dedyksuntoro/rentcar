<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInTblOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_orders', function (Blueprint $table) {
            $table->double('initial_total')->nullable()->after('total_days');
            $table->double('description_add_cost')->nullable()->after('additional_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_orders', function (Blueprint $table) {
            $table->dropColumn('initial_total');
            $table->dropColumn('description_add_cost');
        });
    }
}
