<?php

namespace App\Http\Controllers;

use App\Models\SurveyAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view()
    {
        $user = auth()->user();
        $totalAnswers = $user->getTotalAnswersFromOrganizations()->count();

        $activeSurvey = $user->allActiveSurvey()->count();

        $organizations = $user->organizations()->count();

        $surveys = $user->surveys()->count();

        $totalAnswersMade = $user->surveyAnswers()->where('user_id', $user->id)->count();

        $latestSurveys = $user->allSurveysFromOrganizations()->latest()->take(3)->get();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $rawStatsSurveyAnswers = $user->surveyAnswers()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count')) // Get created date and count answers for the day
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek]) // get only date for the week
            ->groupBy('date') // group by dates
            ->get()
            ->pluck('count', 'date'); // create list for count by days

        $chartLabels = [];
        $chartData = [];

        // loop for every day in the week
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $formattedDate = $date->format('Y-m-d');

            // format label date
            $chartLabels[] = ucfirst($date->translatedFormat('l'));

            // set data to 0 if no data
            $chartData[] = $rawStatsSurveyAnswers->get($formattedDate, 0);
        }


        return view('dashboard', [
            'totalAnswers' => $totalAnswers,
            'activeSurvey' => $activeSurvey,
            'organizations' => $organizations,
            'totalAnswersMade' => $totalAnswersMade,
            'surveys' => $surveys,
            'latestSurveys' => $latestSurveys,
            'user' => $user,
            'chartData' => $chartData,
            'chartLabels' => $chartLabels,
        ]);
    }
}
