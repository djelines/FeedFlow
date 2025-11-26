<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\Survey;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Auth\Access\Response;
use App\Models\SurveyQuestion;

class SurveyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Survey $survey): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create a survey.
     */
    public function create(User $user , String $organization_id): bool
    {
        $organization = Organization::find($organization_id);
        $isFreePlan = $organization->isFreePlan();
        if($isFreePlan){
            return $organization->canCreateSurveyLimit();
        }
        
        return $user->canBeCreateSurvey($user, $organization_id);
    }

       public function createSurvey(User $user, string $organization_id): bool
        {   
            $organization = Organization::find($organization_id);
            //CALL function canBeCreateSurvey for organization.php
            return $organization->canBeCreateSurvey($user);
        }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user , $survey);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user , $survey);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Survey $survey): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Survey $survey): bool
    {
        return false;
    }

    public function limitCreateSurvey(User $user, Survey $survey): bool
    {
        $organization = Organization::find($survey->organization_id);
        $isFreePlan = $organization->isFreePlan();
        if($isFreePlan){
            return $organization->canCreateSurveyLimit();
        }

        return false;
    }

    public function createQuestion(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user, $survey);
    }
    public function deleteQuestion(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user, $survey);
    }
    public function editQuestion(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user, $survey);
    }


    public function createAnswer(User $user, Survey $survey): bool{
        // If the survey is anonymous then return true
        if($survey->is_anonymous){
           return true;
        }
        return true;
    }

    public function limitCreateAnswer(User $user, Survey $survey): bool{
        $isFreePlan = $user->isFreePlan();
        if($isFreePlan){
            return $user->canAnswerSurveyLimit();
        }

        return true;
    }
}
