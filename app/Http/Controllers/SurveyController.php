<?php

namespace App\Http\Controllers;

use App\Actions\Survey\StoreSurveyAction;
use App\Actions\Survey\StoreSurveyAnswerAction;
use App\DTOs\SurveyAnswerDTO;
use App\DTOs\SurveyDTO;
use App\Http\Requests\Survey\StoreSurveyAnswerRequest;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use App\Models\Organization;
use App\Models\SurveyAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Survey;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\SurveyQuestion;
use App\Actions\Survey\DeleteSurveyQuestionAction;
use App\Actions\Survey\UpdateSurveyQuestionAction;
use App\Actions\Survey\DeleteSurveyAction;
use App\Actions\Survey\UpdateSurveyAction;
use App\DTOs\SurveyQuestionDTO;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;
use Illuminate\Http\RedirectResponse;
use App\Actions\Survey\StoreSurveyQuestionAction;
use Illuminate\Support\Facades\Http;
use App\Services\GeminiSurveyService;
use Illuminate\Support\Facades\URL;


class SurveyController extends Controller
{
    use AuthorizesRequests;

    public function view()
    {
        $surveys = auth()->user()->allSurveysFromOrganizations();

        return view('surveys.index', compact('surveys'));
    }


    // Display the specified survey
    public function showSurvey($id)
    {
        $survey = Survey::find($id);

        if (is_null($id) === false) {
            $url = URL::signedRoute(
                'survey.public',
                ['id' => $id]
            );
        }
        return view('surveys.showSurvey', ['survey' => $survey, 'url' => $url]);
    }
    public function store(
        StoreSurveyRequest $request,
        StoreSurveyAction $action,
        StoreSurveyQuestionAction $questionAction,
        GeminiSurveyService $aiService
    ) {

        $dto = SurveyDTO::fromRequest($request);

        $surveyCheck = new Survey((array) $dto);

        if ($request->user()->cannot('limitCreateSurvey', $surveyCheck)) {
            return redirect()->back()->with('error', 'Quota des 3 sondages actifs atteint !');
        }
        $survey = $action->execute($dto);

        if ($request->isAi) {
            try {
                // Generate questions using AI
                $questionsArray = $aiService->generateQuestions(
                    $request->input('ai_prompt'),
                    $request->input('ai_question_count')
                );
                // Save generated questions
                foreach ($questionsArray as $qData) {
                    $questionDto = new SurveyQuestionDTO(
                        survey_id: $survey->id,
                        title: $qData['title'],
                        question_type: $qData['question_type'],
                        options: $qData['options'] ?? [],
                        created_at: now(),
                        updated_at: now(),
                    );
                    $questionAction->execute($questionDto);
                }
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Erreur lors de la génération IA');
            }
        }

        if ($request->is_anonymous) {
            $surveyId = $survey->id;
            if (is_null($surveyId) === false) {
                $url = URL::signedRoute(
                    'survey.public',
                    ['id' => $surveyId]
                );
            }
        }
        return redirect()->back()->with('success', 'Sondage et questions IA créés avec succès !');
    }

    // Store a new question for a survey
    public function storeQuestion(StoreSurveyQuestionRequest $request, StoreSurveyQuestionAction $action): RedirectResponse
    {
        //Create DTO
        $this->authorize('createQuestion', arguments: [Survey::find($request->survey_id)]);
        $dto = SurveyQuestionDTO::fromRequest($request);
        $action->execute($dto);
        return redirect()->back()->with('success', 'Question ajoutée avec succès !');
    }
    // Delete a question from a survey
    public function destroyQuestion(StoreSurveyQuestionRequest $request, DeleteSurveyQuestionAction $action, SurveyQuestion $question): RedirectResponse
    {
        $this->authorize('deleteQuestion', arguments: [Survey::find($question->survey_id)]);
        $dto = SurveyQuestionDTO::fromRequest($request);
        $action->execute($dto, $question);
        return redirect()->back()->with('success', 'Question supprimée avec succès !');
    }
    public function updateQuestion(StoreSurveyQuestionRequest $request , UpdateSurveyQuestionAction $action , SurveyQuestion $question): RedirectResponse
    {   
        $this->authorize('editQuestion', arguments:  [Survey::find($question->survey_id)]);
        $dto = SurveyQuestionDTO::fromRequest($request);
        $action->execute($dto, $question);
        return redirect()->back()->with('success', 'Question modifiée avec succès !');
    }

    //function to edit a survey
    public function updateSurvey(UpdateSurveyRequest $request, UpdateSurveyAction $action, Survey $survey)
    {
        $this->authorize('update', arguments: $survey);
        $dto = SurveyDTO::fromRequest($request);
        $action->update($dto, $survey);
        return redirect()->back()->with("success", "Sondage modifié avec succès !");
    }

    //function to destroy a survey
    public function destroySurvey(Request $request, Survey $survey, DeleteSurveyAction $action): RedirectResponse
    {
        //delete survey in database
        $this->authorize('delete', arguments: $survey);
        $deleteSurvey = $action->delete($survey);
        return redirect()->back()->with('success', 'Sondage supprimé avec succès !');
    }

    //function to fetch a survey
    public function index()
    {
        //fetch all survey in database
        $surveys = Survey::all();

        return view('surveys.survey', compact('surveys'));
    }

    // Function to play survey
    public function viewQuestions($id)
    {

        $survey = Survey::find($id);
        $surveyQuestions = $survey->questions;
        $data = [
            'surveyQuestions' => $surveyQuestions,
            'survey_id' => $id,
        ];
        if (!Auth::check()) {
            if (is_null($id) === false) {
                $url = URL::signedRoute(
                    'survey.answers.public',
                    ['id' => $id]
                );
                $data = [
                    'surveyQuestions' => $surveyQuestions,
                    'survey_id' => $id,
                    'url' => $url
                ];
            }
        }
        return view('surveys.answer.survey', $data);
    }

    public function viewQuestionsAnonymous($id)
    {
        $survey = Survey::find($id);
        $surveyQuestions = $survey->questions;

        return view('surveys.answer.survey', [
            'surveyQuestions' => $surveyQuestions,
            'survey_id' => $id
        ]);
    }

    public function storeAnswers(StoreSurveyAnswerRequest $request, StoreSurveyAnswerAction $action)
    {
        $this->authorize(ability: 'createAnswer', arguments: [Survey::find($request->survey_id)]);

        if ($request->user()->cannot('limitCreateAnswer', arguments: [Survey::find($request->survey_id)])) {
            return redirect()->back()->with('error', 'Quota des 100 reponses mensuels atteint !');
        }
        $dto = SurveyAnswerDTO::fromRequest($request);

        $surveyAnswers = $action->execute($dto);

        $organization_id = Survey::find($dto->survey_id)->organization_id;

        return redirect()->route("organizations.view", $organization_id)->with("success", "Vous avez completé le sondage !");

    }
}
