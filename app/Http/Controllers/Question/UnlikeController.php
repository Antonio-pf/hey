<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class UnlikeController extends Controller
{
    public function __invoke(Question $question)
    {
        user()->unlike($question);

        return back();
    }
}
