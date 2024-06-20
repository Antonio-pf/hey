<?php


use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\patch;
use function Pest\Laravel\put;

it('should be able to archive a question', function () {
    $user = User::factory()->create();

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    actingAs($user);

    patch(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question)
        ->refresh()
        ->deleted_at->not->toBeNull();

});


it('should make sure that only the person who has created the question can archive it', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    actingAs($wrongUser);
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    patch(route('question.archive', $question))
        ->assertForbidden();

    actingAs($rightUser);

    patch(route('question.archive', $question))
        ->assertRedirect();
});
