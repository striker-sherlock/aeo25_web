<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuestionNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $questionNotificationMail;

    public function __construct($questionNotificationMail)
    {
        $this->questionNotificationMail = $questionNotificationMail;
    }

    public function build()
    {
        return $this->markdown('emails.question-notification-mail')
                    ->with('questionNotificationMail', $this->questionNotificationMail)
                    ->subject($this->questionNotificationMail['subject']);
    }

  
}
