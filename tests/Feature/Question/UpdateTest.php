<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\{actingAs, assertDatabaseCount, put, assertDatabaseHas};

it("should be able to update a question", function () {
    // Arange :: preparar
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);


    actingAs($user);

    //Act :: agir
    put(route('question.update', $question), [
        'question' => 'Updated question?',
    ])->assertRedirect(route('question.index'));


    $question->refresh();

    expect($question)
        ->question->toBe('Updated question?');

});


it('should be able to update a new question bigger tan 255 characters', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    // garatir que entra na rota passando a pergunta
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect(route('question.index'));
    assertDatabaseCount('questions', 1);
});


it('should check if ends with question mark ? ', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors([
        'question' => 'Are you sure is a question? It is missing the question mark the end.',
    ]);

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);

    assertDatabaseCount('questions', 1);
});
