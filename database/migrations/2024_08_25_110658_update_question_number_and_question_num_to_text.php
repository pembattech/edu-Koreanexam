<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Changing column type for exam_questions table
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->text('question_number')->change();
        });

        // Changing column type for answers table
        Schema::table('answers', function (Blueprint $table) {
            $table->text('question_num')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting column type for exam_questions table
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('question_number')->change();
        });

        // Reverting column type for answers table
        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedBigInteger('question_num')->change();
        });
    }
};
