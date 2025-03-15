<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurriculumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// Auth
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout');

// Courses
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/admin/courses/create', [CourseController::class,'create'])->name('admin.courses.create');
    Route::post('admin/courses/create', [CourseController::class, 'store']);
    Route::get('/admin/courses/update/{course}', [CourseController::class,'edit'])->name('admin.courses.update');
    Route::post('/admin/courses/update/{course}', [CourseController::class,'update']);
    Route::delete('/admin/courses/delete/{course}', [CourseController::class,'destroy'])->name('admin.courses.delete');
});

// Curricula
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/curricula', [CurriculumController::class,'index'])->name('admin.curricula.index');
    Route::get('/admin/curricula/create', [CurriculumController::class,'create'])->name('admin.curricula.create');
    Route::post('/admin/curricula/create', [CurriculumController::class,'store']);
    Route::get('admin/curricula/update/{curricula}', [CurriculumController::class,'edit'])->name('admin.curricula.update');
    Route::post('/admin/curricula/update/{curricula}', [CurriculumController::class,'update']);
    Route::delete('/admin/curricula/delete/{curricula}', [CurriculumController::class,'destroy'])->name('admin.curricula.delete');
});

// User
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/users', [UserController::class,'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class,'create'])->name('admin.users.create');
    Route::post('/admin/users/create', [UserController::class,'store']);
    Route::get('/admin/users/update/{user}', [UserController::class,'edit'])->name('admin.users.update');
    Route::post('/admin/users/update/{user}', [UserController::class,'update']);
    Route::delete('/admin/users/delete/{user}', [UserController::class,'destroy'])->name('admin.users.delete');
});

// Video
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/videos', [VideoController::class,'index'])->name('admin.videos.index');
    Route::get('/admin/videos/create', [VideoController::class,'create'])->name('admin.videos.create');
    Route::post('/admin/videos/create', [VideoController::class, 'store']);
    Route::get('/admin/videos/show/{video}', [VideoController::class,'show'])->name('admin.videos.show');
    Route::get('/admin/videos/edit/{video}', [VideoController::class,'edit'])->name('admin.videos.update');
    Route::post('/admin/videos/edit/{video}', [VideoController::class,'update']);
    Route::delete('admin/videos/delete/{video}', [VideoController::class,'destroy'])->name('admin.videos.delete');
});
