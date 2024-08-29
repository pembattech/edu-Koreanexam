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
        $candidate_id = auth()->user()->id;

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

    public function detail_result(Request $request){
        $exam_start_time = $request->input('exam_start_time');

        return view('exam_score.detail_result');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $exam_start_time = $request->input('exam_start_time');
            $candidate_id = auth()->user()->id;

            $count_answer = Answer::query()
                ->where('exam_start_time', $exam_start_time)
                ->get()
                ->count();

            if ($count_answer) {

                ExamScore::create([
                    'candidate_id' => $candidate_id,
                    'exam_start_time' => $exam_start_time,
                    'korean_score' => $count_answer,
                ]);

                return response()->json(['total_answered' => $count_answer]);
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
