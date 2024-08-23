<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToExamQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->timestamps(); // Adds `created_at` and `updated_at` columns
        });
    }

    public function down()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            // $table->dropTimestamps(); // Drops `created_at` and `updated_at` columns
        });
    }
}
