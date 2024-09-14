<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSetNumberToExamScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->string('set_number')->after('korean_score')->nullable(); // Adjust the position using 'after'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->dropColumn('set_number');
        });
    }
}
