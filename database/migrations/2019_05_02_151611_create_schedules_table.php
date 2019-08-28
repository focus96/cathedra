<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lecture_hall')->comment('Аудитория');
            $table->integer('couple_number')->comment('Номер пары');
            $table->unsignedInteger('group_id')->comment('Группа');
            $table->unsignedBigInteger('teacher_id')->comment('Преподаватель');
            $table->unsignedInteger('item_id')->comment('Предмет');
            $table->enum('parity_week', ['even', 'odd'])->comment('Четность недели');
            $table->unsignedTinyInteger('day')->comment('День недели');
            $table->string('type')->comment('Тип занятия');
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
        Schema::dropIfExists('schedules');
    }
}
