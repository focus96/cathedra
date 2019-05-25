<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Введенное пользователем имя');
            $table->text('question')->comment('Вопрос пользователя');
            $table->text('answer')->nullable()->comment('Ответ администратора');
            $table->unsignedInteger('telegram_id')->comment('Идентификатор в телеграмме');
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
        Schema::dropIfExists('user_questions');
    }
}
