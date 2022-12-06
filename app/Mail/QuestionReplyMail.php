<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuestionReplyMail extends Mailable
{
    use Queueable, SerializesModels;

   
    public function __construct( $questionReplyMail )
    {
        $this->questionReplyMail = $questionReplyMail;
    }

    public function build()
    {
        return $this->markdown('emails.question_reply_mail')
            ->with([
                'name' => $this->questionReplyMail['name'],
                'question' => $this->questionReplyMail['question'],
                'body' => $this->questionReplyMail['body']
            ])
            ->subject('The 2023 Asian English Olympics Question Reply');
    }

    
   
}
