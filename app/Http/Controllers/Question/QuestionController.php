<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index()
    {
        return view('question.index')
            ->with([
                'questions' => user()->questions
            ]);
    }
    public function store(): RedirectResponse
    {

        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (isset($value) && $value[strlen($value) - 1] != '?') {
                        $fail("Are you sure is a question? It is missing the question mark the end.");
                    }
            },],
        ]);

        user()->questions()->create(
            [
                'question' => request()->question,
                'draft' => true,
            ]
        );

        return  back();
    }

    public function  destroy(Question $question): RedirectResponse
    {

        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }

    public function edit(Question $question): View
    {
        $this->authorize('update', $question);
        return view('question.edit')->with(['question' => $question ]);
    }

    public function update(Question $question): RedirectResponse
    {
        $this->authorize('update', $question);

        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (isset($value) && $value[strlen($value) - 1] != '?') {
                        $fail("Are you sure is a question? It is missing the question mark the end.");
                    }
                },],
        ]);

        $question->question = request()->question;
        $question->save();
        return to_route('question.index');
    }
}
