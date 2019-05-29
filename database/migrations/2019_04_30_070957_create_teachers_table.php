<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname', 50)->comment('Фамилия');
            $table->string('name', 50)->comment('Имя');
            $table->string('last_name', 100)->comment('Отчество');
            $table->enum('academic_degree', ['Ph_D', 'PhD', 'Assistant_professor', 'Professor'])->comment('Ученая степень');
            $table->string('function', 100)->comment('должность на кафедре');
            $table->text('additional_information', 2000)->comment('дополнительная информация ');
            $table->text('specialization', 2000)->comment('специализация ');
            $table->unsignedBigInteger('telegram_id')->nullable()->comment('телеграмм ид ')->unique();
            $table->string('email', 255)->comment('емейл');
            $table->string('phone', 100)->comment('контактный телефон ');
            $table->unsignedTinyInteger('publicity_phone')->comment('признак публичности телефона, то есть отображать ли его публично для всех (0 или 1)');
            $table->unsignedInteger('cathedra_id')->comment('ид кафедры')->nullable();
            //создание внешнего ключа для поля 'cathedra_id', который связан с полем id таблицы 'cathedras'
            $table->foreign('cathedra_id')->references('id')->on('cathedras')->onDelete('cascade');
            $table->string('foto')->comment('фото преподавателя ');
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
        Schema::dropIfExists('teachers');
    }
}
