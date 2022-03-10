<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\FormController;

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
 * Roles
 */
Route::get('/roles', [RoleController::class, 'index'])
    ->name('roles.index');

Route::get('/roles/create', [RoleController::class, 'create'])
    ->name('roles.create');

Route::get('/roles/{role}', [RoleController::class, 'edit'])
    ->name('roles.edit');

Route::post('/roles', [RoleController::class, 'store'])
    ->name('roles.store');

Route::put('/roles/{role}', [RoleController::class, 'update'])
    ->name('roles.update');

Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
    ->name('roles.destroy');



/**
 * User view
 */
Route::get('/users', [UserController::class, 'getUsersView']);
Route::get('/users/{user}', [UserController::class, 'getUserView']);

 /*
 *Role view 
 */
// Route::get('/roles/{role}', [RoleController::class, 'getRoleView']);
// Route::get('/roles', [RoleController::class, 'getRolesView']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Route::get('/roles', [RoleController::class, 'getRolesView']);

Route::get('/sections', [SectionController::class, 'getSectionsView']);

Route::get('/sections/create', [SectionController::class, 'getSectionsCreateView']);

Route::post('/sections', [SectionController::class, 'createSection']);

Route::get('/section/{section}', [SectionController::class, 'getSectionView']);


Route::get('/forms', [FormController::class, 'getFormsView']);

Route::get('/questions', [QuestionController::class, 'getQuestionsView']);

Route::get('/answers', [AnswerController::class, 'getAnswersView']);

Route::get('/questions/{question}', [QuestionController::class, 'getQuestionView']);

require __DIR__.'/auth.php';
