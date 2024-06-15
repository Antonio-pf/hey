<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should be able to list all question created by me', function () {
    $user = User::factory()->create();
    actingAs($user);

    $questions = Question::factory()->for($user, 'createdBy')
        ->count(10)
        ->create();

    $wrongUser = User::factory()->create();
    actingAs($wrongUser);

    $questionsWrong = Question::factory()->for($wrongUser, 'createdBy')
        ->count(10)
        ->create();


    $response = get(route('question.index'));

    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

    foreach ($questionsWrong as $q) {
        $response->assertDontSee($q->question);
    }

});

