<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $rejectMail;
    public function __construct($rejectMail)
    {
        $this->rejectMail = $rejectMail;
    }

    public function build()
    {
        // dd($this->rejectMail['reason']);
        return $this->markdown('emails.rejection_mail')
        ->with([
            'name' => $this->rejectMail['name'],
            'body1' => $this->rejectMail['body1'],
            'body2' => $this->rejectMail['body2'],
            'reason' => $this->rejectMail['reason'],
            'url' => $this->rejectMail['url'],
            
        ]) -> subject($this->rejectMail['subject']);
    }
}
