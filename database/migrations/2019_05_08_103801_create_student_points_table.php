<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_points', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->nullable();
            //создание внешнего ключа для поля 'student_id', который связан с полем id таблицы 'students'
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedInteger('checkpoint_id')->nullable();
            //создание внешнего ключа для поля 'checkpoint_id', который связан с полем id таблицы 'check_points'
            $table->foreign('checkpoint_id')->references('id')->on('check_points')->onDelete('cascade');
            $table->unsignedInteger('journal_id')->nullable();
            //создание внешнего ключа для поля 'journal_id', который связан с полем id таблицы 'online_journals'
            $table->foreign('journal_id')->references('id')->on('online_journals')->onDelete('cascade');
            $table->unsignedInteger('points')->nullable();
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
        Schema::dropIfExists('student_points');
    }
}
