<?php


use App\Models\Question;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;

it('should prune records deleted more than 1 month', function () {
   $question = Question::factory()->create(['deleted_at' => now()->subMonth(2)]);
   assertSoftDeleted('questions', ['id' => $question->id]);


   artisan('model:prune');

   assertDatabaseMissing('questions', ['id' => $question->id]);
});
