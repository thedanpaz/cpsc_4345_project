<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAttemptAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_attempt_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('question_option_id');
            $table->unsignedBigInteger('exam_attempt_id');
            $table->foreign('question_option_id')->references('id')->on('question_options');
            $table->foreign('exam_attempt_id')->references('id')->on('exam_attempts');
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
        Schema::dropIfExists('question_attempt_answers');
    }
}
