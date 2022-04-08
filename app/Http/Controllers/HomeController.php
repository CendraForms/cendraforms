<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class HomeController extends Controller
{
    private int $amount = 10;

    /**
     * Return Home Component Vue with Inertia
     *
     * @return Response Home Component Vue
     */
    public function home()
    {
        // uncomment - test user
        $user = User::first();
        Auth::login($user);
        // $userId = Auth::id();
        // $user = User::where('id', '=', $userId);

        // get user roles names
        $srcUserRoles = $user->roles->all();
        $userRoles = [];
        foreach ($srcUserRoles as $srcUserRole) {
            $userRoles[] = $srcUserRole->name;
        }

        // get user answered forms
        $answeredForms = $user->answeredForms($this->amount);

        // get user forms to be answered
        $formsToBeAnswered = $user->formsToBeAnswered($this->amount)->all();

        // get question counts of forms to be answered
        $formsToBeAnsweredCounts = [];
        foreach ($formsToBeAnswered as $form) {
            $formsToBeAnsweredCounts[] = $form->questionCount();
        }

        // get roles of forms that can be answered by the user
        $formsToBeAnsweredRoles = [];
        foreach ($formsToBeAnswered as $form) {
            $formsToBeAnsweredRoles[] = $form->canBeAnsweredBy();
        }

        // get question counts of answered forms
        $answeredFormsCounts = [];
        foreach ($answeredForms as $form) {
            $answeredFormsCounts[] = $form->questionCount();
        }

        // get roles of user answered forms
        $answeredFormsRoles = [];
        foreach ($answeredForms as $form) {
            $answeredFormsRoles[] = $form->canBeAnsweredBy();
        }

        return inertia('Home', [
            'username' => $user->name,
            'email' => $user->email,
            'roles' => $userRoles,
            'formsToBeAnswered' => $formsToBeAnswered,
            'formsToBeAnsweredCounts' => $formsToBeAnsweredCounts,
            'formsToBeAnsweredRoles' => $formsToBeAnsweredRoles,
            'answeredForms' => $answeredForms,
            'answeredFormsCounts' => $answeredFormsCounts,
            'answeredFormsRoles' => $answeredFormsRoles,
        ]);
    }
}
