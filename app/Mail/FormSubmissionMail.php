<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Formos užpildymo kopija')
                    ->text('emails.form_submission'); // Naudojame „plain text“ šabloną
    }
}
