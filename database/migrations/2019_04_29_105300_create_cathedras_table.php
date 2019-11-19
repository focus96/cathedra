<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCathedrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cathedras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('Наименование кафедры')->unique();
            $table->string('abbreviation', 10)->comment('Аббревиатура кафедры')->unique();
            $table->string('location', 255)->nullable()->comment('Расположение кафедры: корпус, аудитория и тд');
            $table->text('contacts')->nullable()->comment('Контактные данные: емейл, телефон, факс и тд');
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
        Schema::dropIfExists('cathedras');
    }
}
