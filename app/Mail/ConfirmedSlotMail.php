<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmedSlotMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($confirmedMail)
    {
        $this->confirmedMail= $confirmedMail;
    }

    public function build()
    {
        return $this->markdown('emails.confirmed_slot_mail')
        ->with([
            'name' => $this->confirmedMail['name'],
            'body1' => $this->confirmedMail['body1'],
            'body2' => $this->confirmedMail['body2'],
            'url' => $this->confirmedMail['url'],
        ])->subject($this->confirmedMail['subject']);
    }
}
