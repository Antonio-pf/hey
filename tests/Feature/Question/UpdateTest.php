<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\{actingAs, put, assertDatabaseHas};

it("should be able to update a question", function () {
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


it('should make sure that only question with status draft can update it', function () {
    $user = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $draftQuestion = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    // garatir que entra na rota passando a pergunta
    put(route('question.update', $questionNotDraft))->assertForbidden();
    put(route('question.update', $draftQuestion), ['question' => 'New question?'])->assertRedirect();
});


it('should make sure that only question own', function () {
    $user = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true, 'created_by' => $user->id]);

    actingAs($wrongUser);
    put(route('question.update', $question))->assertForbidden();

    actingAs($user);
    put(route('question.update', $question), ['question' => 'New question?'])->assertRedirect();
});
