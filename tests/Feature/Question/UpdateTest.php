<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\{actingAs, put, assertDatabaseHas};

it("should create as draft all the time", function () {
    // Arange :: preparar
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);


    actingAs($user);

    //Act :: agir
    put(route('question.update', $question), [
        'question' => 'Updated question?',
    ])->assertRedirect();


    $question->refresh();

    expect($question)
        ->question->toBe('Updated question?');

});
