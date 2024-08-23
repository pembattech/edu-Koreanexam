<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->text('answer')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            // Indexes
            $table->index(['candidate_id', 'question_id'], 'user_question_idx');

            // Foreign keys
            $table->foreign('candidate_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
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
