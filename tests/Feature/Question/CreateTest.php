<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it("should be able to create a new question bigger than 255 characters", closure: function () {
    // Arange :: preparar
    $user = User::factory()->create();

    actingAs($user);

    //Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 256) . '?',
    ]);

    //Assert :: verificar
    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 256) . '?']);
});

it("should check if ends with question mark ?", function () {
    $user = User::factory()->create();
    actingAs($user);

    //Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    //Assert :: verificar
    $request->assertSessionHasErrors([
        'question' => 'Are you sure is a question? It is missing the question mark the end.'
    ]);
    // não foi criado
    assertDatabaseCount('questions', 0);

});

it("should have at least 10 characters", function () {
    $user = User::factory()->create();
    actingAs($user);

    //Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    //Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    // não foi criado
    assertDatabaseCount('questions', 0);

});

it("should create as draft all the time", function () {
    // Arange :: preparar
    $user = User::factory()->create();

    actingAs($user);

    //Act :: agir
    post(route('question.store'), [
        'question' => str_repeat('*', 256) . '?',
    ]);

    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 256) . '?',
        'draft' => true
    ]);

});

test('only authenticated users can create a new question', function (){
    post(route('question.store'), [
       'question' => str_repeat('*', 8) . '?'
    ])->assertRedirect(route('login'));
});

test('the question should be unique', function (){

    $user = User::factory()->create();
    $question = \App\Models\Question::factory()->create(['question' => 'Some question here?']);

    actingAs($user);

    post(route('question.store'), [
       'question' => $question->question,
    ])->assertSessionHasErrors(['question' => 'question exists']);
});
