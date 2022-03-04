<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\RoleController;
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
Route::get('/sections/{id}', [RoleController::class, 'getSectionid']);
Route::get('/sections', [FormController::class, 'getSections']);
Route::post('/sections', [FormController::class, 'createSection']);
Route::put('/sections/{section}', [RoleController::class, 'updateSection']);
Route::delete('/sections/{section}', [FormController::class, 'deleteSection']);


require __DIR__.'/auth.php';



Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    
    $userExists = User::where('external_id', $user->id)->where('external_auth','google')->exists();
    // $user->token

    if($userExists){
        Auth::login($userExists);
    }else{
      $userNew = User::create([
            'name'=> $user ->name,
            'email'=> $user ->email,
            'avatar'=> $user ->avatar,
            'external_id'=> $user ->id,
            'external_auth'=> 'google',

        ]);

        Auth::login($userNew);
    }

    return redirect('/dashboard');
});
