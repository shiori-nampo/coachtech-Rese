<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;//bladeが使えるようになる

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageContent)
    {
        $this->content = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notice')->subject('運営からのお知らせ');
    }

}
