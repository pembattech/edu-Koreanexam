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
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Foreign key to students table
            $table->string('payment_type', 50); // e.g., Admission fee, Course fee
            $table->decimal('amount', 10, 2); // Payment amount
            $table->string('payment_method', 50); // e.g., Cash, Khalti, Bank Transfer
            $table->date('payment_date'); // Date of payment
            $table->string('transaction_id', 100)->nullable(); // For online payments
            $table->text('remarks')->nullable(); // Additional notes if any
            $table->timestamps();
        
            // Foreign key constraint
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_payments');
    }
};
