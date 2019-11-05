<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mailing extends Mailable
{
    use Queueable, SerializesModels;

    protected $body;

    public function __construct(string $message)
    {
        $this->body = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(env('APP_NAME', "Кафедра АВП"))->view('mails.mailing', [
            'body' => $this->body
        ]);
    }
}
