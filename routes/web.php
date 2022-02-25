<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
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

Route::get('/roles', [RoleController::class, 'getRoles']);

Route::get('/roles/{id}', [RoleController::class, 'getRole']);

Route::post('/roles', [RoleController::class, 'createRole']);

Route::get('/forms', [FormController::class, 'getForms']);

Route::get('/forms/{id}', [FormController::class, 'getForm']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
