<?php

namespace App\Http\Controllers;
use App\Models\Section;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Delete question
     * 
     * @param Question $question question to be deleted
     * @return Response response JSON with status code
     */
    public function deleteQuestion(Question $question)
    {
        $question->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }
    public static function getSection()
    {
        return Section::get();
    }
    
}
