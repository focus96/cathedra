<?php

namespace App\Http\Controllers;

use App\Mail\Mailing;
use App\Models\Mail;
use App\Models\EmailRecipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as MailFacade;

class MailingController extends Controller
{
    public function send(Request $request) {

        $users = $request->input('users', []);
        $message = $request->input('message', '');

        $mail = new Mail;
        $mail->message = $message;
        $mail->save();

        foreach($users as $email) {
            $recipient = new EmailRecipient;
            $recipient->mail_id = $mail->id;
            $recipient->email = $email;

            MailFacade::to($email)->send(new Mailing($message));

            $recipient->save();
        }

        return response()->json([
            'mailId' => $mail->id,
        ]);
    }
}
