<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\StudentPaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamScoresController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamRoutineController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {

    // if (Auth::check()) {
        return Redirect::route('exam_question.index');
    // }

    // return view('dashboard');
})->name('dashboard');

// Authentication routes for students
Route::get('/student/login', [StudentController::class, 'showLoginForm'])->name('student.loginForm');
Route::post('/student/login', [StudentController::class, 'login'])->name('student.login');
Route::post('/student/logout', [StudentController::class, 'logout'])->name('student.logout');


Route::middleware('auth')->group(function () {

    Route::get('exam_question/exam_table', [ExamQuestionController::class, 'exam_table']);
    Route::get('exam_question/exam', [ExamQuestionController::class, 'exam'])->name('exam_question.start_exam');

    // -- Admin route
    Route::post('/students/{id}/toggle-korean', [StudentController::class, 'toggleKoreanStatus'])->name('students.toggle-korean');

    // Create Payment Form (Add payment for a specific student)
    Route::get('students/{student}/payments/create', [StudentPaymentController::class, 'create'])
        ->name('student_payments.create');

    // Store Payment (Save the payment data after form submission)
    Route::post('students/{student}/payments', [StudentPaymentController::class, 'store'])
        ->name('student_payments.store');

    // Edit Payment Form (Edit an existing payment for a specific student)
    Route::get('students/{student}/payments/{payment}/edit', [StudentPaymentController::class, 'edit'])
        ->name('student_payments.edit');

    // Update Payment (Save the updated payment data)
    Route::put('students/{student}/payments/{payment}', [StudentPaymentController::class, 'update'])
        ->name('student_payments.update');


    // Show Payment Details (View the details of a specific payment)
    Route::get('students/{student}/payments/{payment}', [StudentPaymentController::class, 'show'])
        ->name('student_payments.show');

    // Delete Payment (Remove a payment record for a specific student)
    Route::delete('students/{student}/payments/{payment}', [StudentPaymentController::class, 'destroy'])
        ->name('student_payments.destroy');


    // Route::resource('student_payments', StudentPaymentController::class);

    Route::resource('students', StudentController::class);
    route::get('/students/{student}/print', [StudentController::class, 'printStudentDetails'])->name('students.print');



    Route::get('exam_question/view_set/{set_number?}', [ExamQuestionController::class, 'view_set'])->name('exam_question.view_set');
    Route::get('exam_question/check-question-number', [ExamQuestionController::class, 'checkQuestionNumber'])->name('checkQuestionNumber');
    Route::post('/exam_question', [ExamQuestionController::class, 'store']);
    route::post('/exam_question/update', [ExamQuestionController::class, 'update_qn'])->name('exam_question.update_qn');
    route::delete('/exam_question/delete/{question_number?}', [ExamQuestionController::class, 'delete_qn'])->name('exam_question.delete_qn');
    Route::resource('exam_question', ExamQuestionController::class);

    Route::post('set_today_exam/{set?}', [ExamRoutineController::class, 'set_today_exam'])->name('exam_routine.set_today_exam');
    Route::get('show_today_exam', [ExamRoutineController::class, 'show_today_exam'])->name('exam_routine.show_today_exam');
    Route::post('deactivate_previous_and_set_exam/{set?}', [ExamRoutineController::class, 'deactivate_previous_and_set_exam'])->name('exam_routine.deactivate_previous_and_set_exam');
    // --

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
