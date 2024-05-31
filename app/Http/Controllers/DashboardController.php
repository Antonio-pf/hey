<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $questions = Question::all();

        return view('dashboard', [
            'questions' => $questions,
        ]);
    }
}
