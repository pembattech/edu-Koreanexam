<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{

    public function is_answer(Request $request)
    {
        if ($request->ajax()) {

            $question_number = $request->input('questionNumber');
            $setNumber = $request->input('setNumber');

            // Get today's date
            $today = now()->startOfDay();


            $answers = Answer::query()
                ->select('answer')
                // ->whereDate('created_at', $today) // Filter by today's date
                ->where('question_num', $question_number)
                ->where('set', $setNumber)
                ->first();

            if ($answers) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        'is_answer' => true,
                        'question_number' => $question_number,
                        'set_number' => $setNumber,
                        'ans' => $answers,
                    ]
                ]);
            }
        } else {
            return redirect('exam_question');
        }
    }

    public function store_user_choice(Request $request)
    {
        if ($request->ajax()) {
            $question_number = $request->input('question_number');
            $setNumber = $request->input('setNumber');
            $chosenOption = $request->input('chosenOption');
            $candidate_id = auth()->user()->id;

            try {
                $exam_question = ExamQuestion::query()
                    ->select('correct_answer')
                    ->where('question_number', $question_number)
                    ->where('set', $setNumber)
                    ->first();

                if ($exam_question) {

                    // Use regular expression to capture the part after the last '_'
                    preg_match('/_(.+)$/', $chosenOption, $matches);

                    // $matches[1] contains the part after the last '_'
                    $chosenOption = $matches[1];

                    $is_correct = ($exam_question->correct_answer === $chosenOption);

                    // Get today's date
                    $today = now()->startOfDay();

                    Answer::updateOrCreate(
                        [
                            'candidate_id' => $candidate_id,
                            'question_num' => $question_number,
                            'set' => $setNumber,
                            // 'created_at' => $today,
                        ],
                        [
                            'answer' => $chosenOption,
                            'is_correct' => $is_correct
                        ]
                    );

                    return response()->json([
                        'success' => true,
                        'data' => [
                            'candidate_id' => $candidate_id,
                            'question_number' => $question_number,
                            'set_number' => $setNumber,
                            'chosen_option' => $chosenOption,
                            'is_correct' => $request->input(),
                        ]
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Question not found'
                    ]);
                }
            } catch (\Exception $e) {
                // Log the exception to a file
                Log::error('Error in store_user_choice: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return redirect('exam_question');
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
