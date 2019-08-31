<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmSubscribe extends Mailable
{
    use Queueable, SerializesModels;

    protected $subscribeEmail;

    /**
     * Create a new message instance.
     *
     * @param $subscribeEmail
     */
    public function __construct($subscribeEmail)
    {
        $this->subscribeEmail = $subscribeEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.confirm-subscribe', [
            'subscribeEmail' => $this->subscribeEmail
        ]);
    }
}
