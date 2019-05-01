<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('specialty')->comment('Специальность');
            $table->integer('admission_year')->comment('Год поступления');
            $table->integer('group_number')->comment('Номер группы');
            $table->enum('level_education', ['bachelor', 'bachelor_acceleration', 'master'])->comment('Уровень образования');
            $table->enum('form_study', ['daytime', 'correspondence'])->comment('Форма обучения');
            $table->unsignedInteger('curator_id')->comment('Ид куратора группы');
            //создание внешнего ключа для поля 'curator_id', который связан с полем id таблицы 'teachers'
            $table->foreign('curator_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->unsignedInteger('headman_id')->nullable()->comment('Ид старосты группы');
            //создание внешнего ключа для поля 'headman_id', который связан с полем id таблицы 'students'
            //$table->foreign('headman_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('groups');
    }
}
