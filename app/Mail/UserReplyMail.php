<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyData;
    public $originalMessage;

    public function __construct($replyData, $originalMessage)
    {
        $this->replyData = $replyData;
        $this->originalMessage = $originalMessage;
    }

    public function build()
    {
        $subject = $this->replyData['reply_subject'] ?? 'Re: ' . $this->originalMessage->subject;

        return $this->subject($subject)
                    ->view('emails.admin_reply'); // Turo sa email view template
    }
}