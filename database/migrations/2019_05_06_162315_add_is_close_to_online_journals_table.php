<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsCloseToOnlineJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('online_journals', function (Blueprint $table) {
            $table->unsignedInteger('is_close')
                ->after('is_public')
                ->comment('Признак активности');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('online_journals', function (Blueprint $table) {
            $table->dropColumn('is_close');
        });
    }
}
