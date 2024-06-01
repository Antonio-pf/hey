<?php

use App\Http\Controllers\{DashboardController, ProfileController, QuestionController, Question};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    // tirar necessidade de fica logando
    if(app()->isLocal()) {
        auth()->loginUsingId(1);
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');

Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like');
Route::post('/question/unlike/{question}', Question\UnlikeController::class)->name('question.unlike');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
