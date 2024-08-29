<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateQuestionNumberUniqueInExamQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->unique('question_number');
        });
    }

    public function down()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->dropUnique(['question_number']);
        });
    }
}
