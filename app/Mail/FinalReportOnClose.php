<?php

namespace App\Mail;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class FinalReportOnClose extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }
    public function build(): self
    {
        return $this
            ->subject('Voici le report de vos sondages quotidiens')
            ->view('emails.finalReportTemplate');
    }
}