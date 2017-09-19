<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectMail extends Mailable
{
   use Queueable, SerializesModels;
    public $mailbody;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailbody)
    {
        $this->mailbody=$mailbody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.email.reject');
    }
}
