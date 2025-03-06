<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->timestamp('exam_start_time');
            $table->integer('korean_score');
            $table->foreign('candidate_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps(); // This adds the created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_scores');
    }
}
