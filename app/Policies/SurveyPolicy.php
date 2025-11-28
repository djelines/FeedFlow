<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\Survey;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Auth\Access\Response;
use App\Models\SurveyQuestion;
use Illuminate\Database\Eloquent\Builder;

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
     * Determine whether the user can view the surveys.
     */
    public function view(User $user, Survey $survey): bool
    {
        return $user->isUserInOrganization($survey->organization_id);
    }

    /**
     * Return if a survey can be seen
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function viewSurvey(User $user, Survey $survey): bool
    {
        return $user->isUserInOrganization($survey->organization_id)&& $survey->isClosed($survey);
    }

    /**
     * Return if the survey is anonymous and can be accessed
     * @param User|null $user
     * @param Survey $survey
     * @return bool
     */
    public function viewAnonymous(?User $user, Survey $survey): bool
    {
        return $survey->is_anonymous($survey) && $survey->isClosed($survey);
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

        return $organization->canBeCreateSurvey($user);
    }

    /**
     * Determine whether the user can create a survey if is admin/membre/proprio.
     * @param User $user
     * @param string $organization_id
     * @return bool
     */
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

    /**
     * Return if user has reached the threshold of created active survey
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function limitCreateSurvey(User $user, Survey $survey): bool
    {
        $organization = Organization::find($survey->organization_id);
        $isFreePlan = $organization->isFreePlan();
        if($isFreePlan){
            return $organization->canCreateSurveyLimit();
        }
        else {
            return true;
        }
    }

    /**
     * Return if user can create a question
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function createQuestion(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user, $survey);
    }

    /**
     * Return if user can delete a question
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function deleteQuestion(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user, $survey);
    }

    /**
     * Return if user can edit a question
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function editQuestion(User $user, Survey $survey): bool
    {
        return $survey->canBeModifiedOrDeletedBy($user, $survey);
    }


    /**
     * Return if user can create an answer
     * @param User $user
     * @param Survey $survey
     * @return bool
     */
    public function createAnswer(User $user, Survey $survey): bool{
        // If the survey is anonymous then return true
        $organization = Organization::find($survey->organization_id);

        if($organization->exists()){
            if($survey->is_anonymous){
                return true;
            }

            return $user->isUserInOrganization($organization->id);
        }

        return false;
    }

    /**
     * Return if user has reached the threshold of created answers
     * @param User|null $user
     * @param Survey $survey
     * @return bool
     */
    public function limitCreateAnswer(?User $user, Survey $survey): bool{

        $organization = Organization::find($survey->organization_id);
        $isFreePlan = $organization->isFreePlan();
        if($isFreePlan){
            return $organization->canAnswerSurveyLimit();
        }
        return true;
    }
}
