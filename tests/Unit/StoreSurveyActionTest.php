<?php

namespace Tests\Unit;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use App\Models\Organization;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class StoreSurveyActionTest extends TestCase
{
    use RefreshDatabase;

    private StoreSurveyAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new StoreSurveyAction();
    }

    /** @test */
    public function it_can_create_a_survey_with_full_details(): void
    {
        Carbon::setTestNow('2025-01-01 12:00:00'); 
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        $dto = new SurveyDTO(
            title: 'Q1 Employee Feedback',
            description: 'Feedback regarding the first quarter performance.',
            user_id: $user->id,
            organization_id: $organization->id,
            start_date: now(),
            end_date: now()->addDays(7),
            is_anonymous: true
        );

        $survey = $this->action->execute($dto);

        $this->assertInstanceOf(Survey::class, $survey);
        $this->assertEquals('Q1 Employee Feedback', $survey->title);
        
        $this->assertDatabaseHas('surveys', [
            'id' => $survey->id,
            'title' => 'Q1 Employee Feedback',
            'is_anonymous' => true,
            'start_date' => '2025-01-01 12:00:00',
            'end_date' => '2025-01-08 12:00:00',
        ]);
    }

    /** @test */
    public function it_can_create_a_non_anonymous_survey(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        $dto = new SurveyDTO(
            title: 'Public Survey',
            description: 'Not anonymous',
            user_id: $user->id,
            organization_id: $organization->id,
            start_date: now(),
            end_date: now()->addDay(),
            is_anonymous: false // 
        );

        $survey = $this->action->execute($dto);

        $this->assertFalse($survey->is_anonymous);
        $this->assertDatabaseHas('surveys', [
            'id' => $survey->id,
            'is_anonymous' => false,
        ]);
    }

    /** @test */
    public function it_correctly_associates_foreign_keys(): void
    {
        User::factory()->create(); 
        $targetUser = User::factory()->create(); 
        
        Organization::factory()->create(); 
        $targetOrg = Organization::factory()->create();

        $dto = new SurveyDTO(
            title: 'Targeted Survey',
            description: '...',
            user_id: $targetUser->id,
            organization_id: $targetOrg->id,
            start_date: now(),
            end_date: now()->addDays(5),
            is_anonymous: true
        );

        $survey = $this->action->execute($dto);

        $this->assertEquals($targetUser->id, $survey->user_id);
        $this->assertEquals($targetOrg->id, $survey->organization_id);
    }

    /** @test */
    public function it_fails_if_organization_does_not_exist(): void
    {
        $user = User::factory()->create();

        $nonExistentOrgId = 9999;

        $dto = new SurveyDTO(
            title: 'Broken Survey',
            description: '...',
            user_id: $user->id,
            organization_id: $nonExistentOrgId, // Invalid ID
            start_date: now(),
            end_date: now(),
            is_anonymous: true
        );

        $this->expectException(QueryException::class);

        $this->action->execute($dto);
    }

    /** @test */
    public function it_handles_long_descriptions(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        
        $longDescription = str_repeat('A long description. ', 50); 

        $dto = new SurveyDTO(
            title: 'Long Desc Survey',
            description: $longDescription,
            user_id: $user->id,
            organization_id: $organization->id,
            start_date: now(),
            end_date: now(),
            is_anonymous: true
        );

        $survey = $this->action->execute($dto);

        $this->assertDatabaseHas('surveys', [
            'id' => $survey->id,
            'description' => $longDescription,
        ]);
    }
}