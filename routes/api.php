<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//register
Route::post('/register', [AuthController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);
//logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//forgot password
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

//create exam
Route::post('/create-exam', [ExamController::class, 'createExam'])->middleware('auth:sanctum');

//get question exam
Route::get('/get-question-exam', [ExamController::class, 'getListSoalByCategory'])->middleware('auth:sanctum');

//post answer
Route::post('/answers', [ExamController::class, 'answerQuestion'])->middleware('auth:sanctum');
