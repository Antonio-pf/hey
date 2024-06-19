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
            ->paginate(10);

        return view('dashboard', [
            'questions' => $questions,
        ]);
    }
}
