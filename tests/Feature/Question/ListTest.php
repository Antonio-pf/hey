<?php

use App\Models\Question;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should list all questions', function () {
    // Arrange -> preparar
    // create some questions
    $user = \App\Models\User::factory()->create();
    $question = Question::factory()->count(5)->create();
    actingAs($user);

    // Act -> ação
    $response = get(route('dashboard'));


    // Assert -> verificar
    // Verify list all questions
    /** @var Question $questi */
    foreach ($question as $questi) {
        $response->assertSee($questi->question);
    }
});
