<?php

namespace Tests\Unit;

use App\Actions\Survey\StoreSurveyAnswerAction;
use App\DTOs\SurveyAnswerDTO;
use App\Events\SurveyAnswerSubmitted;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class StoreSurveyAnswerActionTest extends TestCase
{
    use RefreshDatabase;

    private StoreSurveyAnswerAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new StoreSurveyAnswerAction();
    }

    /** @test */
    public function it_stores_a_standard_answer_for_identified_user(): void
    {
        $user = User::factory()->create();
        $survey = Survey::factory()->create(['is_anonymous' => false]);

        $question = SurveyQuestion::factory()->create([
            'survey_id' => $survey->id,
            'question_type' => 'single_choice',
            'options' => json_encode(['Rouge', 'Bleu'])
        ]);

        $dto = new SurveyAnswerDTO(
            survey_id: $survey->id,
            user_id: $user->id,
            answers: [
                [
                    'question_id' => $question->id,
                    'response' => 'Rouge' 
                ],
            ]
        );

        $this->action->execute($dto);

        $this->assertDatabaseHas('survey_answers', [
            'survey_id' => $survey->id,
            'user_id' => $user->id, 
            'survey_question_id' => $question->id,
            'answer' => 'Rouge',
        ]);
    }

    /** @test */
    public function it_stores_null_user_id_for_anonymous_surveys(): void
    {
        $user = User::factory()->create();
        $survey = Survey::factory()->create(['is_anonymous' => true]);

        $question = SurveyQuestion::factory()->create(['survey_id' => $survey->id]);

        $dto = new SurveyAnswerDTO(
            survey_id: $survey->id,
            user_id: $user->id, 
            answers: [
                ['question_id' => $question->id, 'response' => 'Test Anonyme'],
            ]
        );

        $this->action->execute($dto);

        $this->assertDatabaseHas('survey_answers', [
            'survey_question_id' => $question->id,
            'answer' => 'Test Anonyme',
            'user_id' => null, 
        ]);
    }

    /** @test */
    public function it_handles_array_answers_as_json(): void
    {
        $user = User::factory()->create();
        $survey = Survey::factory()->create(['is_anonymous' => false]);

        $question = SurveyQuestion::factory()->create([
            'survey_id' => $survey->id,
            'question_type' => 'checkbox',
            'options' => json_encode(['PHP', 'JS', 'Python'])
        ]);

        $choices = ['PHP', 'Python']; 

        $dto = new SurveyAnswerDTO(
            survey_id: $survey->id,
            user_id: $user->id,
            answers: [
                [
                    'question_id' => $question->id,
                    'response' => $choices
                ],
            ]
        );

        $this->action->execute($dto);

        $this->assertDatabaseHas('survey_answers', [
            'survey_question_id' => $question->id,
            'answer' => json_encode($choices), 
        ]);
    }


    /** @test */
    public function it_can_store_multiple_answers_at_once(): void
    {
        $user = User::factory()->create();
        $survey = Survey::factory()->create(['is_anonymous' => false]);

        $q1 = SurveyQuestion::factory()->create(['survey_id' => $survey->id]);
        $q2 = SurveyQuestion::factory()->create(['survey_id' => $survey->id]);

        $dto = new SurveyAnswerDTO(
            survey_id: $survey->id,
            user_id: $user->id,
            answers: [
                ['question_id' => $q1->id, 'response' => 'Réponse 1'],
                ['question_id' => $q2->id, 'response' => 'Réponse 2'],
            ]
        );

        $result = $this->action->execute($dto);

        $this->assertCount(2, $result);
        
        $this->assertDatabaseHas('survey_answers', ['survey_question_id' => $q1->id, 'answer' => 'Réponse 1']);
        $this->assertDatabaseHas('survey_answers', ['survey_question_id' => $q2->id, 'answer' => 'Réponse 2']);
    }

    /** @test */
    public function it_dispatches_survey_submitted_event(): void
    {
        Event::fake(); 

        $creator = User::factory()->create();
        $respondent = User::factory()->create();
        
        $survey = Survey::factory()->create(['user_id' => $creator->id, 'is_anonymous' => false]);
        $question = SurveyQuestion::factory()->create(['survey_id' => $survey->id]);

        $dto = new SurveyAnswerDTO(
            survey_id: $survey->id,
            user_id: $respondent->id,
            answers: [
                ['question_id' => $question->id, 'response' => 'Hello'],
            ]
        );

        $this->action->execute($dto);

        Event::assertDispatched(SurveyAnswerSubmitted::class, function ($event) use ($creator) {
            return $event->ownerEmail === $creator->email;
        });
    }
}