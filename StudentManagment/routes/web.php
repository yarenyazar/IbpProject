<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\AnnouncementController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index_admin'])->name('admin.dashboard');
//admin courses
    Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/admin/courses/save', [CourseController::class, 'save'])->name('admin.courses.save');
    Route::get('/admin/courses/edit/{id}', [CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/admin/courses/update/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::get('/admin/courses/delete/{id}', [CourseController::class, 'delete'])->name('admin.courses.delete');

// admin student

    Route::get('admin/students', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('admin/students/create', [StudentController::class, 'create'])->name('admin.students.create');
    Route::post('admin/students/save', [StudentController::class, 'save'])->name('admin.students.save');
    Route::get('admin/students/edit/{id}', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('admin/students/update/{id}', [StudentController::class, 'update'])->name('admin.students.update');
    Route::get('admin/students/delete/{id}', [StudentController::class, 'delete'])->name('admin.students.delete');

//messages''
    Route::get('admin/messages', [AnnouncementController::class ,'index'])->name('admin.messages.index');
    Route::get('admin/messages/create', [AnnouncementController::class, 'create'])->name('admin.messages.create');
    Route::post('admin/messages/store', [AnnouncementController::class, 'store'])->name('admin.messages.store');

//student message
    Route::get('/admin/student/messages', [UserMessageController::class, 'index'])->name('student.messages.index');

});
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('student/dashboard', [HomeController::class, 'index_student'])->name('student.dashboard');
    Route::get('student', [StudentController::class, 'index'])->name('students.index');

//course
    Route::get('student/courses', [CourseController::class, 'index'])->name('student.courses.index');

    //messages
    Route::get('user_messages', [UserMessageController::class, 'index'])->name('user_messages.index');
    Route::get('user_messages/create', [UserMessageController::class, 'create'])->name('user_messages.create');
    Route::post('user_messages/store', [UserMessageController::class, 'store'])->name('user_messages.store');

//admin messages
    Route::get('student/admin/messages', [AnnouncementController::class ,'index'])->name('admin.student.messages.index');


});


require __DIR__.'/auth.php';

//Route::get('admin/dashboard',[HomeController::class,'index'])->middleware('auth','admin');

