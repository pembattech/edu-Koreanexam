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
            $exam_start_time = $request->input('exam_start_time');

            $answers = Answer::query()
                ->select('answer')
                ->where('question_num', $question_number)
                ->where('set', $setNumber)
                ->where('exam_start_time', $exam_start_time)
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
            $exam_start_time = $request->input('exam_start_time');
            $candidate_id = auth('student')->user()->id;

            try {
                $exam_question = ExamQuestion::query()
                    ->select('correct_answer')
                    ->where('question_number', $question_number)
                    ->where('set', $setNumber)
                    ->first();

                if ($exam_question) {

                    // Extract the suffix after the last underscore
                    preg_match('/_(.+)$/', $chosenOption, $matches);
                    $suffix = $matches[1] ?? ''; // Get the matched suffix or an empty string if not matched

                    // Define a pattern to match unwanted image and audio extensions
                    $extensionsPattern = '/\.(jpeg|png|jpg|gif|svg|mp3|mp4|wav|x-wav|wave)$/i';

                    // Remove unwanted extensions from the suffix
                    $cleanedSuffix = preg_replace($extensionsPattern, '', $suffix);

                    // $matches[1] contains the part after the last '_'
                    $chosenOption = $cleanedSuffix;

                    $is_correct = ($exam_question->correct_answer === $chosenOption);

                    Answer::updateOrCreate(
                        [
                            'candidate_id' => $candidate_id,
                            'question_num' => $question_number,
                            'set' => $setNumber,
                            'exam_start_time' => $exam_start_time,
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
}
