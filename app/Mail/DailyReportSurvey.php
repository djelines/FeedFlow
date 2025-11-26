<?php

namespace App\Mail;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class DailyReportSurvey extends Mailable
{
    use Queueable, SerializesModels;
    public string $surveyName;
    public int $surveyAnswersCount;
    public string $userName;

    public function __construct(string $surveyName, int $surveyAnswersCount, string $userName)
    {
        $this->surveyName = $surveyName;
        $this->surveyAnswersCount = $surveyAnswersCount;
        $this->userName = $userName;
    }
    public function build(): self
    {
        return $this
            ->subject('Voici le rapport de votre sondage : ' . $this->surveyName)
            ->view('emails.dailyReportTemplate');
    }
}