<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('dob');
            $table->char('gender', 1); // M, F, O
            $table->text('address');
            $table->string('contact_number', 15);
            $table->string('email', 100)->unique();
            $table->date('enrollment_date');
            $table->string('present_qualification', 100);
            $table->string('father_name', 100);
            $table->string('mother_name', 100);
            $table->string('profession', 100);
            $table->string('parents_phone_number', 15);
            $table->string('profile_picture')->nullable();
            $table->decimal('total_amount_to_pay', 10, 2)->default(0);
            $table->boolean('is_korean')->default(false);
            $table->string('password')->nullable();
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
        Schema::dropIfExists('students');
    }
}
