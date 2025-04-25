<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileAttachmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizSubmissionController;

Auth::routes();



Route::get('/', function () {
    return view('homelogin');
});

Route::get('/homelogin', function () {
    return view('homelogin');
})->name('homelogin');
Route::get('/loginstudent', function () {
    return view('loginstudent'); })->name('loginstudent');
Route::post('/loginstudent', [LoginController::class, 'loginstudent'] )->name('login.student');
Route::get('/loginteacher', function () {
    return view('loginteacher'); })->name('loginteacher');
    Route::post('/loginteacher', [LoginController::class, 'loginteacher'])->name('login.teacher');



Route::get('/test', function () {return view('test');});

Route::post('/change-password', [AccountController::class, 'changePassword'])->name('change.password');
Route::post('/change-username', [AccountController::class, 'changeUsername'])->name('change.username');

//Admin and CRUD
Route::get('/admin/dashboard', [HomeController::class, 'admindashboard'])->name('admin.dashboard');
Route::get('/admin/account', function () {return view('admin.account');})->name('admin.account');

Route::get('/admin/classes',[ClassController::class, 'index'])->name('classes.index');
Route::post('/admin/classes/store', [ClassController::class, 'store'])->name('classes.store');
Route::patch('/admin/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
Route::delete('/admin/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');

Route::post('/admin/classes/class_major/store', [ClassController::class, 'storeClassMajor'])->name('classMajors.store');
Route::patch('/admin/classes/class_major/{id}', [ClassController::class, 'updateClassMajor'])->name('classMajors.update');
Route::delete('/admin/classes/class_major/{id}', [ClassController::class, 'destroyClassMajor'])->name('classMajors.destroy');
Route::resource('classes', ClassController::class);

Route::post('/admin/classes/attach-subjects', [ClassController::class, 'attachSubjects'])->name('classes.attachSubjects');

Route::get('/admin/subject',[SubjectController::class, 'index'])->name('subjects.index');
Route::post('/admin/subject/store', [SubjectController::class, 'store'])->name('subjects.store');
Route::patch('/admin/subject/{id}', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/admin/subject/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

Route::get('/admin/material',[MaterialController::class, 'index'])->name('material.index');
Route::post('/admin/material/store', [MaterialController::class, 'store'])->name('material.store');
Route::patch('/admin/material/{id}', [MaterialController::class, 'update'])->name('material.update');
Route::delete('/admin/material/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');

Route::get('/admin/file_attachments',[FileAttachmentController::class, 'index'])->name('file_attachments.index');
Route::post('/admin/file_attachments/store',[FileAttachmentController::class, 'store'])->name('file_attachments.store');
Route::patch('/admin/file_attachments/{attachment_id}',[FileAttachmentController::class, 'update'])->name('file_attachments.update');
Route::delete('/admin/file_attachments/{attachment_id}',[FileAttachmentController::class, 'destroy'])->name('file_attachments.destroy');

Route::get('/admin/assignments',[AssignmentSubmissionController::class, 'index'])->name('assignments.index');
Route::delete('/admin/assignments/{id}', [AssignmentSubmissionController::class, 'destroy'])->name('assignments.destroy');

Route::get('/admin/user', [UserController::class, 'index'])->name('users.index');
Route::post('/admin/users/store', [UserController::class, 'store'])->name('users.store');
Route::patch('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::post('admin/user/batch/students', [StudentController::class, 'storeBatch'])->name('batch.students.store');


Route::get('/admin/student',[StudentController::class, 'index'])->name('students.index');
Route::post('/admin/student/batch_assign', [StudentController::class, 'batchAssign'])->name('students.batch_assign');
Route::patch('/admin/student/{id}',[StudentController::class, 'update'])->name('students.update');
Route::delete('/admin/student/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

Route::get('/admin/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::delete('/admin/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');

Route::get('/admin/quizsubmission', [QuizSubmissionController::class, 'index'])->name('quizsubmission.index');
Route::delete('/admin/quizsubmission/{id}', [QuizSubmissionController::class, 'destroy'])->name('quizsubmission.destroy');

//Teacher
Route::get('/teacher/dashboard', function () {return view('teacher.dashboard');});
Route::get('/teacher/account', function () {return view('teacher.account');})->name('teacher.account');
Route::get('/teacher/subjects', [SubjectController::class, 'subjectsindex'])->name('teacher.subjects.index');
Route::get('/teacher/subjects/{id}', [MaterialController::class, 'teacherindex'])->name('teacher.materials.index');
Route::get('/teacher/materials/{material}', [MaterialController::class, 'teachershow'])->name('teacher.materials.show');
    
Route::get('/teacher/material/{material}/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/teacher/material/{material}/quiz', [QuizController::class, 'store'])->name('quiz.store');
Route::get('/teacher/quizzes/{quiz}', [QuizController::class, 'show'])->name('quiz.show');

Route::get('/teacher/quiz-submission/{quizSubmission}', [QuizSubmissionController::class, 'teachershow'])->name('teacher.quiz_submission.show');

Route::get('/teacher/classes', [ClassController::class, 'teacherindex'])->name('teacher.classes.index');


//Student
Route::get('/student/dashboard', function () {return view('student.dashboard');})->name('student.dashboard');
Route::get('/student/subjects', [SubjectController::class, 'studentsubjectsindex'])->name('student.subjects.index');
Route::get('/student/account', function () {return view('student.account');})->name('student.account');
Route::get('/student/subjects/{id}', [MaterialController::class, 'studentindex'])->name('student.materials.index');
Route::get('/student/materials/{material}', [MaterialController::class, 'studentshow'])->name('student.materials.show');
Route::post('/student/assignment-submissions', [AssignmentSubmissionController::class, 'store'])->name('assignment_submissions.store');

Route::get('/student/quizzes/{quiz}', [QuizController::class, 'studentshow'])->name('student.quiz.show');
Route::post('/student/quiz/{quiz}/submit', [QuizSubmissionController::class, 'store'])->name('quiz.submit');

Route::get('/student/quiz-submission/{quizSubmission}', [QuizSubmissionController::class, 'show'])->name('quiz_submission.show');

