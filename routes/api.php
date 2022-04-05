<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AngularController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Roles
 */
Route::get('/roles', [RoleController::class, 'getAll']);

Route::get('/roles/{role}', [RoleController::class, 'get']);

Route::post('/roles', [RoleController::class, 'create']);

Route::put('/roles/{role}', [RoleController::class, 'update']);

Route::delete('/roles/{role}', [RoleController::class, 'delete']);


/**
 * Forms
 */
Route::get('/forms', [FormController::class, 'getAll']);

Route::get('/forms/{form}', [FormController::class, 'get']);

Route::post('/forms', [FormController::class, 'create']);

Route::put('/forms/{form}', [FormController::class, 'update']);

Route::delete('/forms/{form}', [FormController::class, 'delete']);


/**
 * Sections
 */
Route::get('/sections', [SectionController::class, 'getAll']);

// Route::get('/sections/{section}', [SectionController::class, 'get']); // method doesn't exist yet

// Route::post('/sections', [SectionController::class, 'create']); // method doesn't exist yet

Route::put('/sections/{section}', [SectionController::class, 'update']);

Route::delete('/sections/{section}', [SectionController::class, 'delete']);


/**
 * Questions
 */
// Route::get('/questions', [QuestionController::class, 'getAll']); // method doesn't exist yet

Route::get('/questions/{question}', [QuestionController::class, 'get']);

// Route::post('/questions', [QuestionController::class, 'create']); // method doesn't exist yet

Route::put('/questions/{question}', [QuestionController::class, 'update']);

Route::delete('/questions/{question}', [QuestionController::class, 'delete']);


/**
 * Answers
 */
Route::get('/answers', [AnswerController::class, 'getAll']);

Route::get('/answers/{answer}', [AnswerController::class, 'get']);

// Route::post('/answers', [AnswerController::class, 'create']); // method doesn't exist yet

Route::put('/answers/{answer}', [AnswerController::class, 'update']);

Route::delete('/answers/{answer}', [AnswerController::class, 'delete']);

Route::post('/answers', [AnswerController::class, 'create']) ->name('answer.create');

/**
 * Users
 */
// Route::get('/users', [UserController::class, 'getAll']); // method doesn't exist yet

// Route::get('/users/{user}', [UserController::class, 'get']); // method doesn't exist yet

// Route::post('/users', [UserController::class, 'create']); // method doesn't exist yet

// Route::put('/users/{user}', [UserController::class, 'update']); // method doesn't exist yet

// Route::delete('/users/{user}', [UserController::class, 'delete']); // method doesn't exist yet

Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/users/{user}', [UserController::class, 'getUser']);

/**
 * Angular
 */

Route::get('/angular/countforms', [AngularController::class, 'countForms']);
Route::get('/angular/countusers', [AngularController::class, 'countUsers']);
Route::get('/angular/countQuestions', [AngularController::class, 'countQuestions']);
Route::get('/angular/countAnswers', [AngularController::class, 'countAnswers']);
Route::get('/angular/getRoles', [AngularController::class, 'getRoles']);
Route::get('/angular/GetLast10Days', [AngularController::class, 'GetLast10Days']);
Route::get('/angular/AnswersLast10Days', [AngularController::class, 'AnswersLast10Days']);

