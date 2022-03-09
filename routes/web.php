<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\QuestionController;
use App\Models\Section;

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
    return view('welcome');
});

/**
 * User view
 */
Route::get('/users', [UserController::class, 'getUsersView']);
Route::get('/users/{user}', [UserController::class, 'getUserView']);

 /*
 *Role view 
 */
Route::get('/roles/{role}', [RoleController::class, 'getRoleView']);
Route::get('/roles', [RoleController::class, 'getRolesView']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/roles', [RoleController::class, 'getRolesView']);

Route::get('/sections', [SectionController::class, 'getSectionsView']);

Route::get('/sections/create', [SectionController::class, 'getSectionsCreateView']);

Route::post('/sections', [SectionController::class, 'createSection']);

Route::get('/sections/{section}', [SectionController::class, 'updateSectionView']);

Route::put('/sections/{section}', [SectionController::class, 'updateSection']);

Route::get('/forms', [FormController::class, 'getFormsView']);

Route::get('/forms/{form}', [FormController::class, 'updateFormView']);

Route::put('/forms/{form}', [FormController::class, 'updateForm']);

Route::get('/questions', [QuestionController::class, 'getQuestionsView']);

Route::get('/answers', [AnswerController::class, 'getAnswersView']);

require __DIR__.'/auth.php';
