<?php

namespace App\Http\Controllers;

use App\Models\ExamRoutine;
use Illuminate\Http\Request;

class ExamRoutineController extends Controller
{
    public function set_today_exam($set)
    {

        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
        }

        // Get today's date in 'Y-m-d' format
        $today = now()->format('Y-m-d');

        // Check if there is already an exam scheduled for today
        $existingExam = ExamRoutine::where('exam_date', $today)
            ->where('is_active', true)
            ->first(); // Get the first matching record

        // If an exam is already scheduled, return an error response
        if ($existingExam) {
            return response()->json(['success' => false, 'message' => 'An exam is already scheduled for today.'], 409);
        }

        // Create the new exam routine
        ExamRoutine::create([
            'exam_date' => $today,
            'set' => $set,
            'is_active' => true,
        ]);

        return response()->json(['success' => true]);
    }


    public function show_today_exam()
    {
        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
        }

        $today = now()->format('Y-m-d');

        $todayExams = ExamRoutine::where('exam_date', $today)
            ->where('is_active', true)
            ->get();

        if ($todayExams) {

            return response()->json($todayExams);
        }
    }

    public function deactivate_previous_and_set_exam(Request $request, $set)
    {

        // Check if the user is an admin
        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
        }

        // Get today's date in 'Y-m-d' format
        $today = now()->format('Y-m-d');

        // Check if there is already an exam scheduled for today
        $existingExam = ExamRoutine::where('exam_date', $today)
            ->where('is_active', true)
            ->first(); // Get the first matching record

        // Deactivate the previous exam if it exists
        if ($existingExam) {
            $existingExam->is_active = false;
            $existingExam->save();
        }

        // Create the new exam routine
        ExamRoutine::create([
            'exam_date' => $today,
            'set' => $set,
            'is_active' => true,
        ]);

        return response()->json(['success' => true, 'message' => 'Exam updated successfully.']);
    }
}
