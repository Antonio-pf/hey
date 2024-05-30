<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, \Closure $fail) {

                    if ($value[strlen($attribute) - 1] != '?') {
                        $fail("Are you sure is a question? It is missing the question mark the end.");
                    }
            },],
        ]);

        Question::query()->create(
            $attributes
        );

        return  to_route('dashboard');
    }
}
