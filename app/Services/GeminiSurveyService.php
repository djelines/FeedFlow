<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GeminiSurveyService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    /**
     * Generate survey questions using Gemini.
     *
     * @param string $subject 
     * @param int $count 
     * @return array 
     * @throws Exception
     */
    public function generateQuestions(string $subject, int $count): array
    {
        // Build the prompt
        $prompt = $this->buildPrompt($subject, $count);
        // Call Gemini API
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post("{$this->baseUrl}?key={$this->apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $prompt]]]
                ]
            ]);

        if ($response->failed()) {
            throw new Exception('Error communicating with the AI.');
        }
        // Parse and return questions
        return $this->parseResponse($response->json());
    }

    protected function parseResponse(array $responseData): array
    {
        // Clean the response for create good JSON
        $rawText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '[]';
        $cleanJson = str_replace(['```json', '```', "\n"], '', $rawText);      
        $questions = json_decode($cleanJson, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($questions)) {
            throw new Exception('Invalid response format from the AI.');
        }
        return $questions;
    }

    protected function buildPrompt(string $subject, int $count): string
    {
        // Prompt 
        return <<<PROMPT
            Rôle : Tu es un expert créatif en conception de sondages et études de marché.
            Ta mission : Créer un questionnaire engageant, pertinent et original sur le sujet : "{$subject}".
            Objectif : Générer {$count} questions qui sortent de l'ordinaire. Évite les questions trop génériques ou ennuyeuses. Varie les angles (psychologique, pratique, humoristique si le sujet s'y prête).

            CONTRAINTES TECHNIQUES STRICTES (JSON) :
            1. Réponds UNIQUEMENT par un tableau JSON brut.
            2. Chaque objet doit avoir : "title", "question_type", "options".
            3. Types autorisés : "text", "range", "multiple_choice", "single_choice".
            4. "options" doit être un tableau vide pour "text" et "range". Pour les choix, inclure au moins 3 options variées.
            5. Assure-toi que le JSON est valide sans texte additionnel.
            6. Le nombre total de questions doit être exactement {$count}.
            7. Pour les questions à choix multiples et choix uniques il ne doit pas y avoir de "autre a preciser".
            8. Dans les questions type multiple_choice et single_choice ne pas mettre dans la question choisir 4 options car je ne limite pas le nombre d'options.
            RÈGLES DE CONTENU PAR TYPE :
            - "text" : Questions ouvertes invitant à l'expression (ex: "Racontez-nous...", "Quel est votre avis sur..."). Options = [].
            - "range" : Échelles d'évaluation. Le titre DOIT mentionner "sur une échelle de 0 à 10". Options = [].
            - "single_choice" / "multiple_choice" : Propose des choix concrets et variés. Options = ["Choix 1", "Choix 2", "Choix 3"].

            EXEMPLE DE JSON ATTENDU :
            [
            {"title": "Si ce produit était un animal, lequel serait-il ?", "question_type": "text", "options": []},
            {"title": "Sur une échelle de 0 à 10, à quel point cela impacte votre quotidien ?", "question_type": "range", "options": []},
            {"title": "Qu'est-ce qui vous frustre le plus ?", "question_type": "single_choice", "options": ["Le prix", "La lenteur", "Le design"]}
            ]

            IMPORTANT : Pas de markdown, pas de texte avant ou après. Juste le JSON.
        PROMPT;
    }
}