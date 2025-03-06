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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->text('question_num');
            $table->text('answer');
            $table->boolean('is_correct')->default(false);
            $table->text('set');
            $table->timestamp('exam_start_time');
            $table->timestamps();

            // Foreign keys
            $table->foreign('candidate_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

            $table->foreign('question_num')
                ->references('question_number')
                ->on('exam_questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
