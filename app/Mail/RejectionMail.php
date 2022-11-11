<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $rejectMail;
    public function __construct($rejectMail)
    {
        $this->rejectMail = $rejectMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->rejectMail['reason']);
        return $this->markdown('emails.rejection_mail')
        ->with([
            'name' => $this->rejectMail['name'],
            'reason' => $this->rejectMail['reason'],
        ]) -> subject($this->rejectMail['subject']);
    }
}
