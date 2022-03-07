<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function Index()
    {
        //
    }

    public function updateAnswer(Request $request, Answer $answer)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
        ]);

        $answer->content = $validated['content'];

        if (isset($validated['active'])) {
            $answer->active = $validated['active'];
        }

        $answer->save();

        return $answer;
    }
}
