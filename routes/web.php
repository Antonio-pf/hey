<?php

use App\Http\Controllers\{DashboardController, ProfileController, Question, Question\QuestionController};
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


Route::middleware('auth')->group(function () {


    #region Question routes
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like');
    Route::post('/question/unlike/{question}', Question\UnlikeController::class)->name('question.unlike');
    Route::put('/question/publish/{question}', Question\PublishController::class)->name('question.publish');
    #endregion

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // -----
});

require __DIR__ . '/auth.php';
