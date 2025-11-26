<?php

namespace App\Mail;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class FinalReportOnClose extends Mailable
{
    use Queueable, SerializesModels;
    public Survey $survey;
    public int $surveyAnswersCount;
    public string $userName;

    public function __construct(Survey $survey, int $surveyAnswersCount, string $userName)
    {
        $this->survey = $survey;
        $this->surveyAnswersCount = $surveyAnswersCount;
        $this->userName = $userName;
    }
    public function build(): self
    {
        return $this
            ->subject('Votre rapport final pour le sondage : ' . $this->survey->title)
            ->view('emails.finalReportTemplate');
    }
}