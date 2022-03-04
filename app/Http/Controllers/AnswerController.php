<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Delete answer
     * 
     * @param Answer $answer answer to be deleted
     * @return Response response JSON with status code
     */
    public function deleteAnswer(Answer $answer)
    {
        $answer->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }
}
