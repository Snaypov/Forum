<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmAuth extends Mailable
{
    use Queueable, SerializesModels;

    private $user_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.confirm')->with(['email' => $this->user_email]);
    }
}
