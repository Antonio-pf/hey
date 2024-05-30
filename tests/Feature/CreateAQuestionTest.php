<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\post;

it("should be able to create a new question bigger than 255 characters", closure: function () {
    // Arange :: preparar
    $user = User::factory()->create();

    actingAs($user);

    //Act :: agir
    $request = post(route('questions.store'), [
        'question' => str_repeat('*', 256) . '?',
    ]);

    //Assert :: verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    \Pest\Laravel\assertDatabaseHas('questions', ['question' => str_repeat('*', 256) . '?']);
});

it("should check if ends with question mark ?", function () {
    $user = User::factory()->create();
    actingAs($user);

    //Act :: agir
    $request = post(route('questions.store'), [
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
    $request = post(route('questions.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    //Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    // não foi criado
    assertDatabaseCount('questions', 0);

});

