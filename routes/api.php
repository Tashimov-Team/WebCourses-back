<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\V1\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Login
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//Courses
Route::get('/courses', [ApiController::class, 'index']);
Route::get('/courses/{id}', [ApiController::class, 'show']);
Route::middleware('auth:sanctum')->post('/video/progress', [ApiController::class, 'updateProgress']);
Route::middleware('auth:sanctum')->get('/user/courses-progress', [ApiController::class, 'getUserCoursesProgress']);
