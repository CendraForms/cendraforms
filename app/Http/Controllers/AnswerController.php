<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    // todo: function to get specific answer - get()
    // todo: function to create a answer - create()
    // todo: function to update a answer - update()

    /**
     * Gets all answers
     *
     * @return JSON All obtained answers
     */
    public static function getAll()
    {
        return Answer::get();
    }

    /**
     * Deletes parsed Answer
     * 
     * @param Answer $answer Answer to be deleted
     * @return Response JSON response with status code
     */
    public function delete(Answer $answer)
    {
        $answer->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }

    public function update(Request $request, Answer $answer)
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

    public function create(Request $request)
    {
        
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'question_id' => ['required', 'int', 'max:255'],
            'active' => ['sometimes', 'boolean'],
        ]);
        $validated['user_id'] = Auth::id();

        return Answer::create($validated);
    }
}
