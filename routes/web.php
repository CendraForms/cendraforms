<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FormController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/login', function () {
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
