<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname', 50);
            $table->string('name', 50);
            $table->string('family_name', 100);
            $table->integer('telegram_id')->unsigned()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('number', 100)->nullable();
            $table->string('groups_id')->comment('Группа');
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
        Schema::dropIfExists('students');
    }
}
