<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AnswerController extends Controller
{
    /**
     * Manages the request and calls required methods to validate
     * and store user's answers into the database.
     *
     * Collects and validates the request (Form object).
     * Validates that user is logged in, that the form is published,
     * and that the user can answer the form.
     *
     * If validations success, user's answer is stored.
     *
     * @param Request $request Request to be validated and stored
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // validate if user is logged in
        if (!Auth::id()) {
            return redirect()
                ->back()
                ->with('validationErrors', 'user must be authenticated');
        }

        // validate request
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('validationErrors', $validator->errors());
        }

        // obtain validated form
        $validatedForm = $validator->validated()['form'];

        // validate if form isn't published
        if (!$validatedForm['published']) {
            return redirect()
                ->back()
                ->with('validationErrors', 'form is not published');
        }

        // check if user can answer the form
        $userCanAnswerForm = User::where('id', Auth::user()->id)->canAnswerForm();

        if (!$userCanAnswerForm) {
            return redirect()
                ->back()
                ->with('validationErrors', 'you cannot answer this form');
        }

        // store user's answers
        $sections = $validatedForm['sections'];

        foreach ($sections as $section) {
            $questions = $section['questions'];

            foreach ($questions as $question) {
                Answer::create([
                    'content' => $question['answer'],
                    'question_id' => $question['id'],
                    'user_id' => Auth::id(),
                ]);
            }
        }

        return redirect()
            ->back()
            ->with('message', 'answer successfully sent');
    }

    /**
     * Validates parsed request.
     *
     * @param Request $request Validated request.
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateRequest(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), [
            'form.id' => ['required', 'integer'],
            'form.published' => ['required', 'boolean'],

            'form.sections' => ['required', 'array', 'min:1'],
            'form.sections.*.questions' => ['required', 'array', 'min:1'],

            'form.sections.*.questions.*.id' => ['required', 'integer'],
            'form.sections.*.questions.*.answer' => ['required', 'string_or_array'],
        ]);
    }

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
     * Delete answer
     *
     * @param Answer $answer answer to be deleted
     * @return Response response JSON with status code
     */
    public function delete(Answer $answer)
    {
        $answer->delete();

        return response()->json([
            'state' => 'ok',
        ]);
    }

    /**
     * Returns all answers
     *
     * @return JSON
     */
    public static function getAnswers()
    {
        return Answer::get();
        //In Future
        //return view('');
    }

    public function getAnswerView(Answer $answer)
    {

        return view('Answer/answer', ['answer' => $answer]);
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
            'question_id' => ['required', 'integer', 'max:255'],
            'active' => ['required', 'boolean'],
        ]);

        $answer = new Answer();

        $answer->content = $validated['content'];
        $answer->question_id = $validated['question_id'];
        $answer->user_id = Auth::id();

        $answer->save();

        return redirect()->route('/answers')->with('success', 'answer creat.');
    }

   public function CreateAnswerView() {
    return view('Answer/Createanswer');
   }

    public function getAnswersView()
    {
        $answers = $this->getAnswers();

        return view('answers.answers', ['answers' => $answers]);
    }

    /**
     * Returns specified answer object
     *
     * @param Answer $answer specified answer id
     */
    public function get(Answer $answer)
    {
        return $answer;

        //In Future
        //return view('');
    }

}
