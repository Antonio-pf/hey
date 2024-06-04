<?php
namespace Tests\Feature;


use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('should be able to publish question', function () {

    $user = User::factory()->create();
    $question = Question::factory()->create(['draft' => true]);

    actingAs($user);

    put(route('question.publish', $question))
        ->assertRedirect();


    $question->refresh();


    expect($question)->draft->toBeFalse();
});
