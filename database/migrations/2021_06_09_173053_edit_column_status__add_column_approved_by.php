<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnStatusAddColumnApprovedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('status', [1,2,3]);
            $table->integer('approved_by')->after('processed_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('status', [1,2])->change();
            $table->dropColumn('approved_by');
        });
    }
}
