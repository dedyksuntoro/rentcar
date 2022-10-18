<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdentityAgainTblCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_customers', function (Blueprint $table) {
            $table->string('identity_3_image')->nullable()->after('identity_2_number');
            $table->string('identity_3_number')->nullable()->after('identity_3_image');
            $table->string('identity_4_image')->nullable()->after('identity_3_number');
            $table->string('identity_4_number')->nullable()->after('identity_4_image');
            $table->string('identity_5_image')->nullable()->after('identity_4_number');
            $table->string('identity_5_number')->nullable()->after('identity_5_image');
            $table->string('identity_6_image')->nullable()->after('identity_5_number');
            $table->string('identity_6_number')->nullable()->after('identity_6_image');
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
            $table->dropColumn('identity_3_image');
            $table->dropColumn('identity_3_number');
            $table->dropColumn('identity_4_image');
            $table->dropColumn('identity_4_number');
            $table->dropColumn('identity_5_image');
            $table->dropColumn('identity_5_number');
            $table->dropColumn('identity_6_image');
            $table->dropColumn('identity_6_number');
        });
    }
}
