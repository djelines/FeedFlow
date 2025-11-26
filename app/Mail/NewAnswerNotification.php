<?php

namespace App\Mail;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class NewAnswerNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Survey $survey;
    public string $userName;

    public function __construct(Survey $survey, String $userName)
    {
        $this->survey = $survey;
        $this->userName = $userName;
    }
    public function build(): self
    {
        return $this
            ->subject('Nouvelle réponse à votre sondage : ' . $this->survey->title)
            ->view('emails.newAnswerTemplate');
    }
}