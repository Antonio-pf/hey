<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {

//        $questions = Question::all();
        $questions = Question::withSum('votes', 'like')
            ->withSum('votes', 'unlike')
            ->get();

        return view('dashboard', [
            'questions' => $questions,
        ]);
    }
}
