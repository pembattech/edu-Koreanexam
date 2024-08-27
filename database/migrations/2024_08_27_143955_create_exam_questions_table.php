<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_number');
            $table->enum('question_type', ['text', 'image', 'audio']);
            $table->text('question');
            $table->enum('answer_type', ['text', 'image', 'audio']);
            $table->text('option1');
            $table->text('option2');
            $table->text('option3');
            $table->text('option4');
            $table->text('correct_answer');
            $table->text('set');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_questions');
    }
}
