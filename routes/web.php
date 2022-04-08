<?php

use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\SocialiteController;

Route::get('/', [HomeController::class, 'home'])
    ->name('home')
    ->middleware('auth');


/**
 * Auth
 */

Route::get('/accedir', [SocialiteController::class, 'render'])
    ->name('auth');

Route::get('/accedir/{provider}', [SocialiteController::class, 'socialRedirect'])
    ->name('auth.redirect');

Route::get('/accedir/{provider}/callback', [SocialiteController::class, 'socialCallback'])
    ->name('auth.callback');

/**
 * Forms
 */

Route::get('/formulari/crear', [FormController::class, 'create'])
    ->name('form.create')
    ->middleware('auth');

Route::get('/formulari/{form}/editar', [FormController::class, 'edit'])
    ->name('form.edit')
    ->middleware('auth');

Route::post('/formulari/guardar', [FormController::class, 'store'])
    ->name('form.store')
    ->middleware('auth');

Route::get('/formulari/{form}', [FormController::class, 'answer'])
    ->name('form.answer')
    ->middleware('auth');

Route::post('/formulari/{form}', [AnswerController::class, 'store'])
    ->name('answer.store')
    ->middleware('auth');

// todo - temporal
// when deleting this routes, delete also related Vue components
Route::get('/kernel', function () {
    return inertia('kernel');
});
Route::post('/kernel', [FormController::class, 'store']);

Route::get('/kernel/answer/{form}', function () {
    return inertia('kernelAnswer');
});
Route::post('/kernel/answer', [AnswerController::class, 'store']);
// when deleting this routes, delete also related Vue components
// todo - end temporal

/**
 * Roles
 */
Route::get('/roles', [RoleController::class, 'index'])
    ->name('roles.index')
    ->middleware('auth', 'direccio');

Route::get('/roles/crear', [RoleController::class, 'create'])
    ->name('roles.create')
    ->middleware('auth', 'direccio');

Route::get('/roles/{role}/editar', [RoleController::class, 'edit'])
    ->name('roles.edit')
    ->middleware('auth', 'direccio');

Route::post('/roles', [RoleController::class, 'store'])
    ->name('roles.store')
    ->middleware('auth', 'direccio');

Route::put('/roles/{role}', [RoleController::class, 'update'])
    ->name('roles.update')
    ->middleware('auth', 'direccio');

Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
    ->name('roles.destroy')
    ->middleware('auth', 'direccio');

/**
 * Questions
 */
// Route::put('/questions/{question}', [QuestionController::class, 'update'])
//     ->name('questions.update');

/**
 * Users
 */
Route::get('/users', [UserController::class, 'index'])
    ->name('users.index')
    ->middleware('auth', 'professor');

Route::get('/users/crear', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware('auth', 'direccio');

Route::get('/users/{user}/editar', [UserController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth', 'direccio');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware('auth', 'direccio');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware('auth', 'direccio');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth', 'direccio');

/**
 * Roles User
 */
Route::get('/users/{user}/roles', [RoleUserController::class, 'index'])
    ->name('usersroles.index')
    ->middleware('auth', 'professor');

Route::get('/users/{user}/roles/afegir', [RoleUserController::class, 'create'])
    ->name('usersroles.create')
    ->middleware('auth', 'professor');

Route::post('/users/{user}/roles', [RoleUserController::class, 'store'])
    ->name('usersroles.store')
    ->middleware('auth', 'professor');

Route::delete('/users/{user}/roles/{role}', [RoleUserController::class, 'destroy'])
    ->name('usersroles.destroy')
    ->middleware('auth', 'professor');

/**
 * Role view
 */
// Route::get('/roles/{role}', [RoleController::class, 'getRoleView']);
// Route::get('/roles', [RoleController::class, 'getRolesView']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::get('/sections', [SectionController::class, 'getSectionsView']);


// Route::get('/createanswers', [AnswerController::class, 'CreateAnswerView']);


// Route::get('/sections/create', [SectionController::class, 'getSectionsCreateView']);

// Route::post('/sections', [SectionController::class, 'createSection']);

// Route::get('/sections/{section}', [SectionController::class, 'updateSectionView']);

// Route::put('/sections/{section}', [SectionController::class, 'updateSection']);

// Route::get('/forms', [FormController::class, 'index'])
//     ->name('forms.index');

// Route::get('/forms/create', [FormController::class, 'create'])
//     ->name('forms.create');

// Route::get('/forms/{form}', [FormController::class, 'edit'])
//     ->name('forms.edit');

// Route::post('/forms', [FormController::class, 'store'])
//     ->name('forms.store');

// Route::get('/section/{section}', [SectionController::class, 'getSectionView']);

// Route::get('/forms', [FormController::class, 'getFormsView']);

// Route::get('/forms/{form}', [FormController::class, 'updateFormView']);

// Route::put('/forms/{form}', [FormController::class, 'update'])
//     ->name('forms.update');

// Route::get('/section/{section}', [SectionController::class, 'getSectionView']);

// Route::get('/forms', [FormController::class, 'getFormsView']);

// Route::get('/questions', [QuestionController::class, 'getQuestionsView']);

// Route::get('/answers', [AnswerController::class, 'getAnswersView']);

// Route::get('/questions', [QuestionController::class, 'getQuestionsView']);

// Route::get('/questions/{question}', [QuestionController::class, 'getQuestionView']);

// Route::get('/questions/{question}', [QuestionController::class, 'getQuestionView']);

// Route::get('/answer/{answer}', [AnswerController::class, 'getAnswerView']);

// Route::get('/forms/{form}', [FormController::class, 'getFormView']);

require __DIR__ . '/auth.php';
