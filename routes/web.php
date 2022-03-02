<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FormController;
<<<<<<< HEAD
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
=======
use App\Http\Controllers\SectionController;
>>>>>>> 9800b0d4ee2a7f97507b1161c30dc1e91656c494

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

Route::post('/forms', [FormController::class, 'createForm']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/sections', [SectionController::class, 'getSection']);

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
