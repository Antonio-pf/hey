<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('should be able to destroy question', function () {

    $user = User::factory()
        ->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    actingAs($user);

    \Pest\Laravel\delete(route('question.destroy', $question))
        ->assertRedirect();

    \Pest\Laravel\assertDatabaseMissing('questions', ['id' => $question->id]);

});

it('should make sure that only the person who has destroy the question can publish', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    actingAs($wrongUser);
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    \Pest\Laravel\delete(route('question.destroy', $question))
        ->assertForbidden();

    actingAs($rightUser);

    \Pest\Laravel\delete(route('question.destroy', $question))
        ->assertRedirect();
});


