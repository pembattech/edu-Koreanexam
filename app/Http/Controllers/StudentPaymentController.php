<?php

namespace App\Http\Controllers;

use App\Models\StudentPayment;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentPaymentController extends Controller
{
    // Display all payments
    public function index()
    {
        $payments = StudentPayment::with('student')->latest()->get();
        return view('student_payments.index', compact('payments'));
    }

    // Show form to create a new payment
    public function create(Student $student)
    {
        // dd($student);
        // The $student is automatically resolved by Laravel
        return view('student_payments.create', compact('student'));
    }



    // Store a new payment
    public function store(Request $request, $studentId)
    {
        // dd($request);
        // Validate the form data
        $validated = $request->validate([
            'payment_type' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'payment_date' => ['required', 'date', 'after_or_equal:today'],
            'transaction_id' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
        ]);

        // Create a new student payment record
        StudentPayment::create([
            'student_id' => $studentId, // Foreign key to the student
            'payment_type' => $validated['payment_type'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_date' => $validated['payment_date'],
            'transaction_id' => $validated['transaction_id'],
            'remarks' => $validated['remarks'],
        ]);

        // Redirect back or to a specific page with a success message
        return redirect()->route('students.show', $studentId)->with('success', 'Payment added successfully.');
    }


    // Show a single payment
    public function show($id)
    {
        $payment = StudentPayment::with('student')->findOrFail($id);
        return view('student_payments.show', compact('payment'));
    }

    // Show form to edit a payment
    public function edit($studentId, $paymentId)
    {
        $studentPayment = StudentPayment::where('id', $paymentId)
            ->where('student_id', $studentId)
            ->firstOrFail();

        return view('student_payments.edit', compact('studentPayment'));
    }


    // Update a payment
    public function update(Request $request, $studentId, $paymentId)
    {
        // dd($request->all());

        $payment = StudentPayment::where('id', $paymentId)
            ->where('student_id', $studentId)
            ->firstOrFail();

        // dd($payment);

        $validatedData = $request->validate([
            'payment_type' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'payment_date' => ['required', 'date', 'after_or_equal:today'],
            'transaction_id' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
        ]);

        $validatedData['student_id'] = $studentId;


        $payment->update($validatedData);

        return redirect()->route('students.show', $studentId)->with('success', 'Payment updated successfully!');
    }


    // Delete a payment
    public function destroy($id)
    {
        $payment = StudentPayment::findOrFail($id);
        $payment->delete();
        return redirect()->route('student_payments.index')->with('success', 'Payment deleted successfully!');
    }
}
