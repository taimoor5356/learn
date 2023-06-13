<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [QuestionAnswerController::class, 'index']);
Route::get('/learn', [QuestionAnswerController::class, 'index'])->name('questions_answers');
Route::get('/categories', [CategoryController::class, 'index'])->name('cateories');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category_store');
Route::post('/answer/store', [QuestionAnswerController::class, 'store'])->name('store_question_answer');
Route::post('/questions/fetch', [QuestionController::class, 'fetchQuestions'])->name('fetch_questions');
Route::post('/answers/fetch', [AnswerController::class, 'fetchAnswers'])->name('fetch_answers');
Route::post('/answer/update', [AnswerController::class, 'update'])->name('update_answer');