<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\ExamScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamScoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->is_admin) {

            // Fetch all exam scores with related user information
            $examScores = ExamScore::with('student')
            ->orderBy('exam_start_time', 'desc')
            ->get();

            // Return the results to a view or as JSON
            return view('exam_score.admin_result', compact('examScores'));
        } else {

            $candidate_id = auth('student')->user()->id;

            $exam_scores = ExamScore::query()
                ->where('candidate_id', $candidate_id)
                ->get()
                ->map(function ($score) use ($candidate_id) {
                    $correct_answers_count = DB::table('answers')
                        ->where('candidate_id', $candidate_id)
                        ->where('exam_start_time', $score->exam_start_time) // Using exam_start_time from ExamScore
                        ->where('is_correct', true)
                        ->count();

                    $score->correct_answers_count = $correct_answers_count;

                    return $score;
                });


            return view('exam_score.result', ['exams_score' => $exam_scores]);
        }
    }

    public function detail_result(Request $request)
    {

        // dd($request);
        $exam_start_time = $request->query('exam_start_time');

        $answered_questions = Answer::query()
            ->where('exam_start_time', $exam_start_time)
            ->with(['examQuestion']) // Load the related exam question using Eloquent relationships
            ->get();

        // Access the 'set' from the related 'examQuestion' of the first answered question
        $answered_set_num = $answered_questions->first()->examQuestion['set'];

        return view('exam_score.detail_result', ['answered_questions' => $answered_questions, 'answered_set_num' => $answered_set_num, 'exam_start_time' => $exam_start_time]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->ajax()) {
            $exam_start_time = $request->input('exam_start_time');
            $set_number = $request->input('set_number');
            $candidate_id = auth('student')->user()->id;

            // Retrieve the collection of answers
            $retrive_answer = Answer::query()
                ->where('exam_start_time', $exam_start_time)
                ->get();

            // Count the number of records in the collection
            $count_answer = $retrive_answer->count();

            // Get all the 'is_correct' values from the collection
            $correct_answers = $retrive_answer->pluck('is_correct');

            // Count the total number of correct answers
            $total_correct = $correct_answers->sum();

            if ($count_answer > 0) {

                ExamScore::create([
                    'candidate_id' => $candidate_id,
                    'exam_start_time' => $exam_start_time,
                    'set_number' => $set_number,
                    'korean_score' => $count_answer,
                ]);

                return response()->json(['total_answered' => $count_answer, 'total_correct' => $total_correct]);
            } else {
                return response()->json(['total_answered' => 0]);
            }
        }

        return redirect("dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamScore $examScore)
    {
        //
    }
}
