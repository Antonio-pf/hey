<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function __invoke(): View
    {


        $questions = Question::withSum('votes', 'like')
            ->when(request()->has('search'), function (Builder $query) {
                $query->where('question', 'like', '%' . request()->search . '%');
            })
            ->withSum('votes', 'unlike')
            ->orderByRaw('
                case when votes_sum_like is null then 0 else votes_sum_like end desc,
                case when votes_sum_unlike is null then 0 else votes_sum_unlike end')
            ->paginate(10);

        return view('dashboard', [
            'questions' => $questions,
        ]);
    }
}
