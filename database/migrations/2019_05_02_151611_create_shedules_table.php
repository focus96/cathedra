<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lecture_hall')->comment('Аудитория');
            $table->integer('couple_number')->comment('Номер пары');
            $table->string('group')->comment('Группа');
            $table->string('teacher')->comment('Преподаватель');
            $table->enum('parity_week', ['even', 'odd'])->comment('Четность недели');
            $table->string('day')->comment('День недели');
            $table->enum('type_occupation', ['laboratory_work', 'practical_lesson', 'lecture'])->comment('Тип занятия');
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
        Schema::dropIfExists('shedules');
    }
}
