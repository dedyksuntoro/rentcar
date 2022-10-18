<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdentityTblCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_customers', function (Blueprint $table) {
            $table->string('identity_1_image')->nullable()->after('address');
            $table->string('identity_1_number')->nullable()->after('identity_1_image');
            $table->string('identity_2_image')->nullable()->after('identity_1_number');
            $table->string('identity_2_number')->nullable()->after('identity_2_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_customers', function (Blueprint $table) {
            $table->dropColumn('identity_1_image');
            $table->dropColumn('identity_1_number');
            $table->dropColumn('identity_2_image');
            $table->dropColumn('identity_2_number');
        });
    }
}
