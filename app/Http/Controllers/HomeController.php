<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class HomeController extends Controller
{
    private $limit = 10;

    /**
     * Return Home Component Vue with Inertia
     *
     * @return Response Home Component Vue
     */
    public function home()
    {
        // $user = User::where('id', 3)->get();

        // Auth::login($user[0]);

        // Return Home Component Vue with Inertia
        return inertia('Home', [
            'avaiableForms' => Auth::user()->formsToBeAnswered($this->limit),
            'answeredForms' => Auth::user()->answeredForms($this->limit),
            'userLogin' => Auth::user(),
            'roleLogin' => Auth::user()->roles,
        ]);
    }
}
