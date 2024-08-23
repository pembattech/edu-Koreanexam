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
        //
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

        // dd($request->all());

        $data = $request->validate([
            'question_number' => ['required', 'unique:exam_questions'],
            'question_type' => ['required', 'string'],
            'question_description' => ['required_if:question_type,text', 'nullable', 'string'],
            'question_description_image' => ['required_if:question_type,image', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'answer_type' => ['required', 'string'],
            'option_1' => ['required_if:answer_type,text', 'nullable', 'string'],
            'option_1_image' => ['required_if:answer_type,image', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_2' => ['required_if:answer_type,text', 'nullable', 'string'],
            'option_2_image' => ['required_if:answer_type,image', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_3' => ['required_if:answer_type,text', 'nullable', 'string'],
            'option_3_image' => ['required_if:answer_type,image', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'option_4' => ['required_if:answer_type,text', 'nullable', 'string'],
            'option_4_image' => ['required_if:answer_type,image', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'correct_answer' => ['required', 'string'],
        ]);

        // dd($data);

        // // Handle the question description image if the question type is 'image'
        // if ($request->question_type === 'image' && $request->hasFile('question_description_image')) {
        //     $questionImageName = time() . '_question.' . $request->question_description_image->extension();
        //     $request->question_description_image->move(public_path('exam_images'), $questionImageName);
        //     $data['question_description'] = $questionImageName;
        // }

        if ($request->hasFile('question_description_image')) {
            $imageName = time() . '.' . $request->question_description_image->extension();
            $request->question_description_image->move(public_path('exam_images'), $imageName);
            $data['question_description'] = $imageName;
        }




        // Handle the option images if the answer type is 'image'
        for ($i = 1; $i <= 4; $i++) {
            $optionKey = 'option_' . $i;
            $optionImageKey = 'option_' . $i . '_image';
            if ($request->answer_type === 'image' && $request->hasFile($optionImageKey)) {

                $optionImageName = time() . '_option_' . $i . '.' . $request->$optionImageKey->extension();
                $request->$optionImageKey->move(public_path('exam_images'), $optionImageName);
                $data[$optionKey] = $optionImageName;
            } else {
                $data[$optionKey] = $request->$optionKey . '_option_' . $i;
            }
        }

        // dd($data);


        // Create the exam question
        ExamQuestion::create([
            "question_number" => $data['question_number'],
            "question_type" => $data['question_type'],
            "question" => $data['question_description'],
            "answer_type" => $data['answer_type'],
            "option1" => $data['option_1'],
            "option2" => $data['option_2'],
            "option3" => $data['option_3'],
            "option4" => $data['option_4'],
            "correct_answer" => $data['correct_answer'],
        ]);

        // return redirect()->route('exam_question.index')->with('success', 'Exam question created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(ExamQuestion $examQuestion)
    {
        //
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
    public function update(Request $request, ExamQuestion $examQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamQuestion $examQuestion)
    {
        //
    }
}
