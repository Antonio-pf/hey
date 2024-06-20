<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Question;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Classifiers\NaiveBayes;
use Rubix\ML\CrossValidation\Metrics\Accuracy;

class AnalyzeQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analyze-questions';
    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Analyze questions using machine learning';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all questions and their IDs
        $questions = Question::all()->pluck('question')->toArray();
        $questionIds = Question::all()->pluck('id')->toArray();

        // Labels (using question IDs as labels for example)
        $labels = $questionIds;

        // Create labeled dataset
        $dataset = new Labeled($questions, $labels);

        // Initialize and train the classifier (example: Naive Bayes)
        $estimator = new NaiveBayes();
        $estimator->train($dataset);

        // Evaluate the model (example: using accuracy)
        $predictions = $estimator->predict($dataset);
        $accuracy = (new Accuracy())->score($predictions, $labels);

        $this->info("Model accuracy: $accuracy");

        return 0;
    }
}
