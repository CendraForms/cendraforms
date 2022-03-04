<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\QuestionController;

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
Route::get('/roles', [RoleController::class, 'getRoles']);

Route::get('/roles/{role}', [RoleController::class, 'getRole']);

Route::post('/roles', [RoleController::class, 'createRole']);

Route::put('/roles/{role}', [RoleController::class, 'updateRole']);

Route::delete('/roles/{role}', [RoleController::class, 'deleteRole']);


/**
 * Forms
 */
Route::get('/forms', [FormController::class, 'getForms']);

Route::get('/forms/{form}', [FormController::class, 'getForm']);

Route::post('/forms', [FormController::class, 'createForm']);

Route::put('/forms/{form}', [FormController::class, 'updateForm']);

Route::delete('/forms/{form}', [FormController::class, 'deleteForm']);


/**
 * Sections
 */
Route::get('/sections', [SectionController::class, 'getSections']);

// Route::get('/sections/{section}', [SectionController::class, 'getSection']); method doesn't exist yet

// Route::post('/sections', [SectionController::class, 'createSection']); method doesn't exist yet

Route::put('/sections/{section}', [SectionController::class, 'updateSection']);

Route::delete('/sections/{section}', [SectionController::class, 'deleteSection']);


/**
 * Questions
 */
// Route::get('/questions', [QuestionController::class, 'getQuestions']); method doesn't exist yet

Route::get('/questions/{question}', [QuestionController::class, 'getQuestion']);

// Route::post('/questions', [QuestionController::class, 'createQuestion']); method doesn't exist yet

Route::put('/questions/{question}', [QuestionController::class, 'updateQuestion']);

Route::delete('/questions/{question}', [QuestionController::class, 'deleteQuestion']);


/**
 * Answers
 */
Route::get('/answers', [AnswerController::class, 'getAnswers']);

Route::get('/answers/{question}', [AnswerController::class, 'getAnswer']);

// Route::post('/answers', [AnswerController::class, 'createAnswer']); method doesn't exist yet

// Route::put('/answers/{question}', [AnswerController::class, 'updateAnswer']); method doesn't exist yet

// Route::delete('/answers/{question}', [AnswerController::class, 'deleteAnswer']); method doesn't exist yet
