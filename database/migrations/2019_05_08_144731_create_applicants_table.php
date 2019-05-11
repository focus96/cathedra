<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telegram_name')->comment('Имя в телеграмме');
            $table->string('name')->comment('Имя, предоставленное пользователем');
            $table->string('city')->comment('Город');
            $table->string('occupation')->comment('Учеба/работа');
            $table->unsignedInteger('telegram_id')->nullable()->comment('Идентификатор в телеграмме');
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
        Schema::dropIfExists('applicants');
    }
}
