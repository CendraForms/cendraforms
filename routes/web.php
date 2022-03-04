<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\QuestionController;

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

Route::get('/roles', [RoleController::class, 'getRoles']);

Route::get('/roles/{role}', [RoleController::class, 'getRoleView']);

Route::post('/roles', [RoleController::class, 'createRole']);

Route::put('/roles/{role}', [RoleController::class, 'updateRole']);

Route::delete('/roles/{role}', [RoleController::class, 'deleteRole']);

Route::get('/forms', [FormController::class, 'getForms']);

Route::delete('/sections/{section}', [Section::class, 'deleteSection']);

Route::get('/forms/{form}', [FormController::class, 'getForm']);

Route::post('/forms', [FormController::class, 'createForm']);

Route::delete('/forms/{form}', [FormController::class, 'deleteForm']);

Route::put('/sections/{section}', [SectionController::class, 'updateSection']);

Route::delete('/questions/{question}', [QuestionController::class, 'deleteQuestion']);

Route::put('/questions/{question}', [QuestionController::class, 'updateQuestion']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/questions/{question}', [QuestionController::class, 'getQuestion']);

Route::get('/sections', [SectionController::class, 'getSection']);


require __DIR__.'/auth.php';
