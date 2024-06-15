<?php
namespace Tests\Feature;


use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('should be able to publish question', function () {

    $user = User::factory()
        ->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    actingAs($user);

    put(route('question.publish', $question))
        ->assertRedirect();


    $question->refresh();


    expect($question)->draft->toBeFalse();
});

it('should make sure that only the person who has created the question can publish', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    actingAs($wrongUser);
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    put(route('question.publish', $question))
        ->assertForbidden();

    actingAs($rightUser);

    put(route('question.publish', $question))
        ->assertRedirect();
});


