<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam_sets = ExamQuestion::query()
            ->orderBy('set', 'asc') // Order by 'set' column in ascending order
            ->distinct('set') // distinct('set'): Ensures that only unique values for the set column are selected.
            ->pluck('set'); // pluck('set'): Retrieves an array of the values from the set column.

        return view('exam_question.index', ['exam_sets' => $exam_sets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!request()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('exam_question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!request()->user()->isAdmin()) {
            return redirect()->back();
        }

        $data = $request->validate([
            'set_number' => ['required', 'integer'],
            'question_number' => ['required', 'unique:exam_questions'],
            'heading' => ['required', 'string'],
            'question_type' => ['required', 'string'],
            'question_description' => ['required_if:question_type,text', 'string'],
            'question_description_image' => ['required_if:question_type,image', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'question_description_audio' => [
                'required_if:question_type,audio',
                'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave',
                'max:2048'
            ],
            'answer_type' => ['required', 'string'],
            'option_1' => ['required_if:answer_type,text', 'string'],
            'option_1_image' => ['required_if:answer_type,image', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_1_audio' => ['required_if:answer_type,audio', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'], // Adjust max size as needed
            'option_2' => ['required_if:answer_type,text', 'string'],
            'option_2_image' => ['required_if:answer_type,image', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_2_audio' => ['required_if:answer_type,audio', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'], // Adjust max size as needed
            'option_3' => ['required_if:answer_type,text', 'string'],
            'option_3_image' => ['required_if:answer_type,image', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_3_audio' => ['required_if:answer_type,audio', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'], // Adjust max size as needed
            'option_4' => ['required_if:answer_type,text', 'string'],
            'option_4_image' => ['required_if:answer_type,image', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_4_audio' => ['required_if:answer_type,audio', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'], // Adjust max size as needed
            'correct_answer' => ['required', 'string'],
        ]);

        // Handle the question description image or audio file
        if ($request->question_type === 'image' && $request->hasFile('question_description_image')) {
            $imageName = time() . '.' . $request->question_description_image->extension();
            $request->question_description_image->move(public_path('exam_assets/images/question_image'), $imageName);
            $data['question_description'] = $imageName;
        } elseif ($request->question_type === 'audio' && $request->hasFile('question_description_audio')) {
            $audioName = time() . '.' . $request->question_description_audio->extension();
            $request->question_description_audio->move(public_path('exam_assets/audio/question_audio'), $audioName);
            $data['question_description'] = $audioName;
        }

        // Handle the option images or audio files if the answer type is 'image' or 'audio'
        for ($i = 1; $i <= 4; $i++) {
            $optionKey = 'option_' . $i;
            $optionImageKey = 'option_' . $i . '_image';
            $optionAudioKey = 'option_' . $i . '_audio';

            if ($request->answer_type === 'image' && $request->hasFile($optionImageKey)) {
                $optionImageName = time() . '_option_' . $i . '.' . $request->$optionImageKey->extension();
                $request->$optionImageKey->move(public_path('exam_assets/images/option_image'), $optionImageName);
                $data[$optionKey] = $optionImageName;
            } elseif ($request->answer_type === 'audio' && $request->hasFile($optionAudioKey)) {
                $optionAudioName = time() . '_option_' . $i . '.' . $request->$optionAudioKey->extension();
                $request->$optionAudioKey->move(public_path('exam_assets/audio/option_audio'), $optionAudioName);
                $data[$optionKey] = $optionAudioName;
            } else {
                $data[$optionKey] = $request->$optionKey . '_option_' . $i;
            }
        }


        // dd($data);



        // Update or Create the exam question
        $exam_question_create = ExamQuestion::updateOrCreate(
            [
                // Criteria to find the existing record
                "set" => "set_" . $data['set_number'],
                "question_number" => "set_" . $data['set_number'] . "_" . $data['question_number']
            ],
            [
                // Data to create or update
                "heading" => $data['heading'],
                "question_type" => $data['question_type'],
                "question" => $data['question_description'],
                "answer_type" => $data['answer_type'],
                "option1" => $data['option_1'],
                "option2" => $data['option_2'],
                "option3" => $data['option_3'],
                "option4" => $data['option_4'],
                "correct_answer" => $data['correct_answer'],
            ]
        );


        if ($exam_question_create) {
            return response()->json(['success' => true]);
        }


        // // Storing user data in session
        // session(['user_id' => 1, 'user_name' => 'John Doe']);

        // // Retrieving user data from session
        // $userName = session('user_name'); // Outputs: John Doe


        // dd($userName);


        // return redirect()->route('exam_question.index')->with('success', 'Exam question created successfully.');
    }

    // public function exam_table()
    // {
    //     if (request()->ajax()) {

    //         $questionNumber = request()->query('questionNumber');
    //         $setNumber = request()->query('setNumber');

    //         $exam_question = ExamQuestion::query()
    //             ->where('question_number', $questionNumber)
    //             ->where('set', $setNumber)
    //             ->get();

    //         return response()->json(['success' => $exam_question]);
    //     } else {

    //         return redirect("exam_question");
    //     }
    // }

    public function exam(Request $request)
    {
        if (request()->ajax()) {

            $questionNumber = request()->query('questionNumber');
            $setNumber = request()->query('setNumber');

            $exam_question = ExamQuestion::query()
                ->where('question_number', $questionNumber)
                ->where('set', $setNumber)
                ->get();

            return response()->json(['success' => $exam_question]);
        }
        // dd($request);
        // $questionNumber = $number;

        // Example query to get questions based on the set and question number
        // $questions = ExamQuestion::where('set', $set)
        //     ->where('question_number', $questionNumber)
        //     ->get();

        // // Example: returning the questions as a response
        // return response()->json($questionNumber
        // );
        return view('exam_question.exam');
    }



    /**
     * Display the specified resource.
     */
    public function show(ExamQuestion $examQuestion)
    {
        // $exam_question = ExamQuestion::query();

        // return view()
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamQuestion $examQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_qn(Request $request)
    {
        if (!request()->user()->isAdmin()) {
            return redirect()->back();
        }

        $data = $request->validate([
            'set_number' => ['required', 'integer'],
            'question_number' => ['required'],
            'heading' => ['nullable', 'string'],
            'question_type' => ['nullable', 'string'],
            'question_description' => ['nullable', 'string'],
            'question_description_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'question_description_audio' => [
                'nullable',
                'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave',
                'max:2048'
            ],
            'answer_type' => ['nullable', 'string'],
            'option_1' => ['nullable', 'string'],
            'option_1_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_1_audio' => ['nullable', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'],
            'option_2' => ['nullable', 'string'],
            'option_2_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_2_audio' => ['nullable', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'],
            'option_3' => ['nullable', 'string'],
            'option_3_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_3_audio' => ['nullable', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'],
            'option_4' => ['nullable', 'string'],
            'option_4_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_4_audio' => ['nullable', 'mimetypes:audio/mpeg,audio/mp4,audio/wav,audio/x-wav,audio/wave', 'max:20480'],
            'correct_answer' => ['nullable', 'string'],
        ]);

        // Fetch the existing exam question
        $examQuestion = ExamQuestion::where([
            "set" => "set_" . $data['set_number'],
            "question_number" => "set_" . $data['set_number'] . "_" . $data['question_number']
        ])->first();

        // Check if question type or answer type has changed
        $isQuestionTypeChanged = $examQuestion->question_type !== $request->question_type;
        $isAnswerTypeChanged = $examQuestion->answer_type !== $request->answer_type;

        // Validate new data if the question type or answer type has changed
        if ($isQuestionTypeChanged) {
            if ($request->question_type === 'image' && !$request->hasFile('question_description_image')) {
                return response()->json(['error' => 'New question image is required when changing the question type to image.'], 400);
            }
            if ($request->question_type === 'audio' && !$request->hasFile('question_description_audio')) {
                return response()->json(['error' => 'New question audio is required when changing the question type to audio.'], 400);
            }
            if ($request->question_type === 'text' && !$request->filled('question_description')) {
                return response()->json(['error' => 'Question description is required when changing the question type to text.'], 400);
            }
        }

        if ($isAnswerTypeChanged) {
            for ($i = 1; $i <= 4; $i++) {
                $optionRequestKey = 'option_' . $i;
                $optionImageKey = 'option_' . $i . '_image';
                $optionAudioKey = 'option_' . $i . '_audio';

                if ($request->answer_type === 'image' && !$request->hasFile($optionImageKey)) {
                    return response()->json(['error' => 'New image for option ' . $i . ' is required when changing the answer type to image.'], 400);
                }
                if ($request->answer_type === 'audio' && !$request->hasFile($optionAudioKey)) {
                    return response()->json(['error' => 'New audio for option ' . $i . ' is required when changing the answer type to audio.'], 400);
                }
                if ($request->answer_type === 'text' && !$request->filled($optionRequestKey)) {
                    return response()->json(['error' => 'Text for option ' . $i . ' is required when changing the answer type to text.'], 400);
                }
            }
        }

        // Handle the question description image or audio file
        if ($request->question_type === 'image' && $request->hasFile('question_description_image')) {
            $imageName = time() . '.' . $request->question_description_image->extension();
            $request->question_description_image->move(public_path('exam_assets/images/question_image'), $imageName);
            $examQuestion->question = $imageName;
        } elseif ($request->question_type === 'audio' && $request->hasFile('question_description_audio')) {
            $audioName = time() . '.' . $request->question_description_audio->extension();
            $request->question_description_audio->move(public_path('exam_assets/audio/question_audio'), $audioName);
            $examQuestion->question = $audioName;
        } else if ($request->filled('question_description')) {
            $examQuestion->question = $request->question_description;
        }

        // Handle the option images or audio files if the answer type is 'image' or 'audio'
        for ($i = 1; $i <= 4; $i++) {
            $optionKey = 'option' . $i; // Database column name without underscore
            $optionRequestKey = 'option_' . $i; // Form input name with underscore
            $optionImageKey = 'option_' . $i . '_image';
            $optionAudioKey = 'option_' . $i . '_audio';

            if ($request->answer_type === 'image' && $request->hasFile($optionImageKey)) {
                $optionImageName = time() . '_option_' . $i . '.' . $request->$optionImageKey->extension();
                $request->$optionImageKey->move(public_path('exam_assets/images/option_image'), $optionImageName);
                $examQuestion->$optionKey = $optionImageName;
            } elseif ($request->answer_type === 'audio' && $request->hasFile($optionAudioKey)) {
                $optionAudioName = time() . '_option_' . $i . '.' . $request->$optionAudioKey->extension();
                $request->$optionAudioKey->move(public_path('exam_assets/audio/option_audio'), $optionAudioName);
                $examQuestion->$optionKey = $optionAudioName;
            } elseif ($request->filled($optionRequestKey)) {
                $examQuestion->$optionKey = $request->$optionRequestKey;
            }
        }


        // Update other fields if provided
        if ($request->filled('heading')) {
            $examQuestion->heading = $data['heading'];
        }
        if ($request->filled('question_type')) {
            $examQuestion->question_type = $data['question_type'];
        }
        if ($request->filled('answer_type')) {
            $examQuestion->answer_type = $data['answer_type'];
        }
        if ($request->filled('correct_answer')) {
            $examQuestion->correct_answer = $data['correct_answer'];
        }

        // Save the updated exam question
        if ($examQuestion->save()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Failed to update question.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamQuestion $examQuestion)
    {
        //
    }
}
