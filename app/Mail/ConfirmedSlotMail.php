<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmedSlotMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmedMail)
    {
        $this->confirmedMail= $confirmedMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirmed_slot_mail')
        ->with([
            'name' => $this->confirmedMail['name'],
            'body' => $this->confirmedMail['body'],
            'url' => $this->confirmedMail['url'],
        ])->subject($this->confirmedMail['subject']);
    }
}
