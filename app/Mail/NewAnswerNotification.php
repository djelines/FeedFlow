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

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }
    public function build(): self
    {
        return $this
            ->subject('Hello bb i love you talk with me I have big boobs')
            ->view('emails.newAnswerTemplate')
            ->with([
                'survey' => $this->survey,
            ]);
    }
}