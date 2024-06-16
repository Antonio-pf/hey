<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('can open a question to edit', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();
    actingAs($user);

    // garatir que entra na rota passando a pergunta
    get(route('question.edit', $question))->assertSuccessful();
});
