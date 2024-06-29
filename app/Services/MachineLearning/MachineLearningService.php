<?php

namespace App\Services\MachineLearning;

use App\Models\Question;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Transformers\TfIdfVectorizer;
class MachineLearningService
{

    public function processQuestions()
    {
        $questions = Question::all();



   


    }


}
