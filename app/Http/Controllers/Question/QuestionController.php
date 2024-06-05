<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
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

        return  to_route('dashboard');
    }
}
