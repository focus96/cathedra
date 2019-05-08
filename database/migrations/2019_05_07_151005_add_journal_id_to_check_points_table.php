<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJournalIdToCheckPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('check_points', function (Blueprint $table) {
            $table->unsignedInteger('journal_id')
                ->after('name')
                ->comment('Ид журнала');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('check_points', function (Blueprint $table) {
            $table->dropColumn('journal_id');
        });
    }
}
