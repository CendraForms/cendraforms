<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/auth/discord/redirect', function () {
    //dd(Socialite::driver('discord'));
    return Socialite::driver('discord')->redirect();
});

Route::get('/auth/discord/callback', function () {
    $user = Socialite::driver('discord')->user();

    dd($user);

    if (Str::endsWith($user->getEmail(), '@cendrassos.net')) {
        echo "Email is @cendrassos.net";
    } else {
        echo "Email is not @cendrassos.net";
    }

    // $user->token
});

Route::get('/', function () {
    // return view('welcome');
    return Inertia::render('Form/Create');
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
 * Questions
 */
Route::put('/questions/{question}', [QuestionController::class, 'update'])
    ->name('questions.update');

/**
 * User view
 */
Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');

Route::get('/users/{user}', [UserController::class, 'edit'])
    ->name('users.edit');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update');

/**
 * Role view
 */
// Route::get('/roles/{role}', [RoleController::class, 'getRoleView']);
// Route::get('/roles', [RoleController::class, 'getRolesView']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/sections', [SectionController::class, 'getSectionsView']);


Route::get('/createanswers', [AnswerController::class, 'CreateAnswerView']);


Route::get('/sections/create', [SectionController::class, 'getSectionsCreateView']);

Route::post('/sections', [SectionController::class, 'createSection']);

Route::get('/sections/{section}', [SectionController::class, 'updateSectionView']);

Route::put('/sections/{section}', [SectionController::class, 'updateSection']);

Route::get('/forms', [FormController::class, 'index'])
    ->name('forms.index');

Route::get('/forms/create', [FormController::class, 'create'])
    ->name('forms.create');

Route::get('/forms/{form}', [FormController::class, 'edit'])
    ->name('forms.edit');

Route::post('/forms', [FormController::class, 'store'])
    ->name('forms.store');

Route::get('/section/{section}', [SectionController::class, 'getSectionView']);

Route::get('/forms', [FormController::class, 'getFormsView']);

Route::get('/forms/{form}', [FormController::class, 'updateFormView']);

Route::put('/forms/{form}', [FormController::class, 'update'])
    ->name('forms.update');

Route::get('/section/{section}', [SectionController::class, 'getSectionView']);

Route::get('/forms', [FormController::class, 'getFormsView']);

Route::get('/questions', [QuestionController::class, 'getQuestionsView']);

Route::get('/answers', [AnswerController::class, 'getAnswersView']);

Route::get('/questions', [QuestionController::class, 'getQuestionsView']);

Route::get('/questions/{question}', [QuestionController::class, 'getQuestionView']);

Route::get('/questions/{question}', [QuestionController::class, 'getQuestionView']);

Route::get('/answer/{answer}', [AnswerController::class, 'getAnswerView']);

Route::get('/forms/{form}', [FormController::class, 'getFormView']);

require __DIR__ . '/auth.php';
