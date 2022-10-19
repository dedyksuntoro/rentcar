<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnTblCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_customers', function (Blueprint $table) {
            $table->string('identity_7_image')->nullable()->after('identity_6_number');
            $table->string('identity_7_number')->nullable()->after('identity_7_image');
            $table->string('identity_8_image')->nullable()->after('identity_7_number');
            $table->string('identity_8_number')->nullable()->after('identity_8_image');
            $table->text('reason_banned')->nullable()->after('status');
            $table->string('reason_banned_image')->nullable()->after('reason_banned');
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
            $table->dropColumn('identity_7_image');
            $table->dropColumn('identity_7_number');
            $table->dropColumn('identity_8_image');
            $table->dropColumn('identity_8_number');
            $table->dropColumn('reason_banned');
            $table->dropColumn('reason_banned_image');
        });
    }
}
