<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\{actingAs, get};

it('can open a question to edit', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();
    actingAs($user);

    // garatir que entra na rota passando a pergunta
    get(route('question.edit', $question))->assertSuccessful();
});

it('can return a view', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();
    actingAs($user);

    // garatir que entra na rota passando a pergunta
    get(route('question.edit', $question))->assertViewIs('question.edit');
});

it('should make sure that only question with status draft can edit it', function () {
    $user = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $draftQuestion = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    // garatir que entra na rota passando a pergunta
    get(route('question.edit', $questionNotDraft))->assertForbidden();
    get(route('question.edit', $draftQuestion))->assertSuccessful();
});
