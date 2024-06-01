<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should vote a question', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.like', $question));

    // consulta o banco se exite o registro
    assertDatabaseHas('votes', [
        'id' => $question->id,
        'like' => 1,
        'unlike' => 0,
        'user_id' => $user->id,
    ]);

});
