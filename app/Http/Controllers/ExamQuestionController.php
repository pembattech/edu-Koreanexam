<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Models\ExamRoutine;
use App\Models\Answer;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!request()->user()->isAdmin()) {
            // Get today's date in 'Y-m-d' format
            $today = now()->format('Y-m-d');

            // Retrieve exam routines where exam_date is today
            $todayExams = ExamRoutine::where('exam_date', $today)
                ->where('is_active', true)
                ->first();


            return view('exam_question.index', ['todayExams' => $todayExams]);
        } else {
            $exam_sets = ExamQuestion::select('set', DB::raw('count(*) as total_questions'))
                ->groupBy('set')
                ->get();

            return view('exam_question.admin_index', ['exam_sets' => $exam_sets]);
        }
    }


    public function view_set($set_number = null)
    {
        if (is_null($set_number) || !request()->user()->isAdmin()) {
            return redirect('dashboard');
        }

        $questionsWithAnswers = ExamQuestion::where('set', $set_number)
            ->get();

        return view('exam_question.view_set', ['list_of_qn' => $questionsWithAnswers, 'set' => $set_number]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
        }

        return view('exam_question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
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

            $image = $request->file('question_description_image');

            // Create an instance of ImageManager with the GD driver
            $manager = new ImageManager(new Driver());

            // Read the uploaded image
            $img = $manager->read($image->getPathname());

            $img->scaleDown(width: 700);

            // Save the resized image
            $img->save(public_path('exam_assets/images/question_image/' . $imageName));
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

                $optionImage = $request->file($optionImageKey);
                
                // Create an instance of ImageManager with the GD driver
                $option_manager = new ImageManager(new Driver());
    
                // Read the uploaded image
                $option_img = $option_manager->read($optionImage->getPathname());
    
                $option_img->scaleDown(width: 700);
    
                // Save the resized image
                $option_img->save(public_path('exam_assets/images/option_image/' . $optionImageName));
                $data[$optionKey] = $optionImageName;

            } elseif ($request->answer_type === 'audio' && $request->hasFile($optionAudioKey)) {
                $optionAudioName = time() . '_option_' . $i . '.' . $request->$optionAudioKey->extension();
                $request->$optionAudioKey->move(public_path('exam_assets/audio/option_audio'), $optionAudioName);
                $data[$optionKey] = $optionAudioName;
            } else {
                $data[$optionKey] = $request->$optionKey . '_option_' . $i;
            }
        }

        // Create the exam question
        $exam_question_create = ExamQuestion::create([
            "set" => "set_" . $data['set_number'],
            "question_number" => "set_" . $data['set_number'] . "_" . $data['question_number'],
            "heading" => $data['heading'],
            "question_type" => $data['question_type'],
            "question" => $data['question_description'],
            "answer_type" => $data['answer_type'],
            "option1" => $data['option_1'],
            "option2" => $data['option_2'],
            "option3" => $data['option_3'],
            "option4" => $data['option_4'],
            "correct_answer" => $data['correct_answer'],
        ]);


        if ($exam_question_create) {
            return response()->json(['success' => true]);
        }
    }

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

        return view('exam_question.exam');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_qn(Request $request)
    {
        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
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
    public function delete_qn($question_number = null)
    {


        // dd($question_number);

        if (is_null($question_number)) {
            return redirect('dashboard');
        }

        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
        }

        $question = ExamQuestion::where('question_number', $question_number)->firstOrFail();

        $question->delete();

        return response()->json(['success' => 'Question deleted successfully.']);
    }

    public function checkQuestionNumber(Request $request)
    {
        if (!request()->user()->isAdmin()) {
            return redirect('dashboard');
        }

        $setNumber = 'set_' . $request->input('set_number');
        $questionNumber = $setNumber . '_' . $request->input('question_number');

        // Check if the question number exists for the set
        $exists = ExamQuestion::where('question_number', $questionNumber)
            ->where('set', $setNumber)
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
