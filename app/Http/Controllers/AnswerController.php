<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

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
}
