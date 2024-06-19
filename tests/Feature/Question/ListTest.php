<?php

use App\Models\Question;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should list all questions', function () {
    // Arrange -> preparar
    // create some questions
    $user = User::factory()->create();
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

it('should paginate question', function () {
    $user = User::factory()->create();
    $questions = Question::factory()->count(20)->create();
    actingAs($user);

    $response = get(route('dashboard'))
    ->assertViewHas('questions', function ($value) {
        return $value instanceof LengthAwarePaginator;
    });

});


it('should order by and unlike', function () {
    $user = User::factory()->create();

    Question::factory()->count(5)->create();
    $mostLiked = Question::find(1);
    $user->like($mostLiked);

    $unlikeQuestion = Question::find(3);
    $user->unlike($unlikeQuestion);

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) use ($mostLiked, $unlikeQuestion) {
            expect($questions)
                ->first()->id->toBe(1)
                ->and($questions)
                ->last()->id->toBe(3);
            return true;
        });
});
