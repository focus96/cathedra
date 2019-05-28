<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCathedraInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cathedra_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caption')->comment('Заголовок');
            $table->text('answer')->comment('Сообщение');
            $table->string('image')->nullable();
            $table->tinyInteger('active')->default(1)->comment('Активность: 0 - не активный, 1 - активный');
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
        Schema::dropIfExists('cathedra_info');
    }
}
