<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Survey;
use App\Models\SurveyQuestion;

class SurveyQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SurveyQuestion::class;

    public function definition(): array
    {
        return [
            // Laravel créera automatiquement un Survey si aucun n'est fourni
            'survey_id' => Survey::factory(),
            
            'title' => fake()->sentence() . '?',
            'question_type' => 'single_choice',
            
            // CORRECTION : On met un JSON valide par défaut
            'options' => json_encode(['Option A', 'Option B']), 
        ];
    }
}