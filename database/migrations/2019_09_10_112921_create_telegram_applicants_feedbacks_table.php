<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelegramApplicantsFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_applicants_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('telegram_id');
            $table->text('question');
            $table->text('answer')->nullable();
            $table->boolean('is_answered')->default(false);
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

    }
}
