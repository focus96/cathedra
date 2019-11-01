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
            $table->string('academic_degree')->nullable()->comment('Ученая степень');
            $table->string('function')->nullable()->comment('должность на кафедре');
            $table->longText('additional_information')->nullable()->comment('дополнительная информация ');
            $table->longText('specialization')->nullable()->comment('специализация ');
            $table->unsignedBigInteger('telegram_id')->nullable()->comment('телеграмм ид ')->unique();
            $table->string('email')->nullable()->comment('емейл');
            $table->string('phone')->nullable()->comment('контактный телефон ');
            $table->unsignedTinyInteger('publicity_phone')->nullable()->comment('признак публичности телефона, то есть отображать ли его публично для всех (0 или 1)');
            $table->unsignedInteger('cathedra_id')->nullable()->comment('ид кафедры')->nullable();
            $table->string('foto')->nullable()->comment('фото преподавателя ');
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
