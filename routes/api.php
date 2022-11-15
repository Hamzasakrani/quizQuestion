<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('getquestions', [
    QuestionController::class, "getQuetions"
])->middleware('auth:sanctum');
Route::post('responseQuetions', [
    QuestionController::class, "responseQuetions"
])->middleware('auth:sanctum');
Route::get('getAnswersByQuestion', [
    QuestionController::class, "getAnswersByQuestion"
])->middleware('auth:sanctum');
Route::get('checkexiste', [
    QuestionController::class, "checkexiste"
])->middleware('auth:sanctum');