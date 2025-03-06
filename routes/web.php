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

// Redirect to exam page if logged in
Route::get('/', function () {
    if ((Auth::check()) || (Auth::guard('student')->check())) {
        return Redirect::route('exam_question.index');
    }

    return view('dashboard');
})->name('dashboard');

// Authentication routes for students
Route::get('/student/login', [StudentController::class, 'showLoginForm'])->name('student.loginForm');
Route::post('/student/login', [StudentController::class, 'login'])->name('student.login');
Route::post('/student/logout', [StudentController::class, 'logout'])->name('student.logout');

// Admin Routes with admin guard


// Admin routes for managing students and payments
Route::post('/students/{id}/toggle-korean', [StudentController::class, 'toggleKoreanStatus'])->name('students.toggle-korean');
Route::get('students/{student}/payments/create', [StudentPaymentController::class, 'create'])->name('student_payments.create');
Route::post('students/{student}/payments', [StudentPaymentController::class, 'store'])->name('student_payments.store');
Route::get('students/{student}/payments/{payment}/edit', [StudentPaymentController::class, 'edit'])->name('student_payments.edit');
Route::put('students/{student}/payments/{payment}', [StudentPaymentController::class, 'update'])->name('student_payments.update');
Route::get('students/{student}/payments/{payment}', [StudentPaymentController::class, 'show'])->name('student_payments.show');
Route::delete('students/{student}/payments/{payment}', [StudentPaymentController::class, 'destroy'])->name('student_payments.destroy');
Route::resource('students', StudentController::class);
Route::get('/students/{student}/print', [StudentController::class, 'printStudentDetails'])->name('students.print');

// Exam management routes
Route::get('exam_question/exam_table', [ExamQuestionController::class, 'exam_table']);
Route::get('exam_question/exam', [ExamQuestionController::class, 'exam'])->name('exam_question.start_exam');
Route::get('exam_question/view_set/{set_number?}', [ExamQuestionController::class, 'view_set'])->name('exam_question.view_set');
Route::get('exam_question/check-question-number', [ExamQuestionController::class, 'checkQuestionNumber'])->name('checkQuestionNumber');
Route::post('/exam_question', [ExamQuestionController::class, 'store']);
Route::post('/exam_question/update', [ExamQuestionController::class, 'update_qn'])->name('exam_question.update_qn');
Route::delete('/exam_question/delete/{question_number?}', [ExamQuestionController::class, 'delete_qn'])->name('exam_question.delete_qn');
Route::resource('exam_question', ExamQuestionController::class);

// Exam routine routes
Route::post('set_today_exam/{set?}', [ExamRoutineController::class, 'set_today_exam'])->name('exam_routine.set_today_exam');
Route::get('show_today_exam', [ExamRoutineController::class, 'show_today_exam'])->name('exam_routine.show_today_exam');
Route::post('deactivate_previous_and_set_exam/{set?}', [ExamRoutineController::class, 'deactivate_previous_and_set_exam'])->name('exam_routine.deactivate_previous_and_set_exam');

// Answer routes
Route::get('answer/is-answer', [AnswerController::class, 'is_answer'])->name('answer.is_answer');
Route::post('answer/store-user-choice', [AnswerController::class, 'store_user_choice'])->name('answer.store');

// Exam scores routes
Route::get('exam_score', [ExamScoresController::class, 'index'])->name('exam_score.result');
Route::post('exam_score/store', [ExamScoresController::class, 'store'])->name('exam_score.store');
Route::get('exam_score/detail', [ExamScoresController::class, 'detail_result'])->name('exam_score.detail_result');


// Student Routes with student guard
// Route::middleware('auth:student')->group(function () {

// Routes for student profile and exam
Route::get('exam_question/exam', [ExamQuestionController::class, 'exam'])->name('exam_question.start_exam');
Route::get('exam_question/view_set/{set_number?}', [ExamQuestionController::class, 'view_set'])->name('exam_question.view_set');
Route::get('exam_question/check-question-number', [ExamQuestionController::class, 'checkQuestionNumber'])->name('checkQuestionNumber');
Route::get('answer/is-answer', [AnswerController::class, 'is_answer'])->name('answer.is_answer');
Route::post('answer/store-user-choice', [AnswerController::class, 'store_user_choice'])->name('answer.store');

Route::get('exam_score', [ExamScoresController::class, 'index'])->name('exam_score.result');
Route::post('exam_score/store', [ExamScoresController::class, 'store'])->name('exam_score.store');
Route::get('exam_score/detail', [ExamScoresController::class, 'detail_result'])->name('exam_score.detail_result');

// Profile routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Default route for handling login and dashboard
require __DIR__ . '/auth.php';
