<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamScoresController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    
    if (Auth::check()) {
        return Redirect::route('exam_question.index');
    }

    return view('dashboard');

})->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('exam_question/exam_table', [ExamQuestionController::class, 'exam_table']);
    Route::get('exam_question/exam', [ExamQuestionController::class, 'exam'])->name('exam_question.start_exam');
    Route::post('/exam_question', [ExamQuestionController::class, 'store']);
    route::post('/exam_question/update', [ExamQuestionController::class, 'update_qn'])->name('exam_question.update_qn');
    route::delete('/exam_question/delete/{question_number}', [ExamQuestionController::class, 'delete_qn'])->name('exam_question.delete_qn');
    Route::resource('exam_question', ExamQuestionController::class);

    Route::get('answer/is-answer', [AnswerController::class, 'is_answer'])->name('answer.is_answer');
    Route::post('answer/store-user-choice', [AnswerController::class, 'store_user_choice'])->name('answer.store');

    Route::get('exam_score', [ExamScoresController::class, 'index'])->name('exam_score.result');
    Route::post('exam_score/store', [ExamScoresController::class, 'store'])->name('exam_score.store');
    Route::get('exam_score/detail', [ExamScoresController::class, 'detail_result'])->name('exam_score.detail_result');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
