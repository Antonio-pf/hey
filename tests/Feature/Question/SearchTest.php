<?php
use App\Models\User;
use App\Models\Question;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it("should be able to search a question by text ?", function () {
    $user = User::factory()->create();
    Question::factory()->create(['question' => 'Wrong question?' ]);
    Question::factory()->create(['question' => 'Testing my question?']);
    actingAs($user);

    // Act -> ação
    $response = get(route('dashboard', ['search' => 'Testing my question?']));

    $response->assertSee('Testing my question?');
    $response->assertDontSee('Wrong question?');
});
