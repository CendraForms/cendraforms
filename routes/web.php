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

Route::get('/roles/{role}', [RoleController::class, 'getRole']);

Route::post('/roles', [RoleController::class, 'createRole']);

Route::put('/role/{role}', [RoleController::class, 'updateRole']);

Route::delete('/roles/{role}', [RoleController::class, 'deleteRole']);

Route::get('/forms', [FormController::class, 'getForms']);

<<<<<<< HEAD
Route::get('/forms/{id}', [FormController::class, 'getForm']);
=======
Route::post('/forms', [FormController::class, 'createForm']);

Route::delete('/forms/{form}', [FormController::class, 'deleteForm']);

Route::delete('/questions/{question}', [QuestionController::class, 'deleteQuestion']);
>>>>>>> d5702eb1d1798d1221ed4192f1768b468176af48

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

<<<<<<< HEAD
=======
Route::get('/sections', [SectionController::class, 'getSection']);
>>>>>>> d5702eb1d1798d1221ed4192f1768b468176af48

require __DIR__.'/auth.php';
