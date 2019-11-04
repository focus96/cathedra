<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\EmailRecipient;
use Illuminate\Http\Request;

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

            // TODO: send mail

            $recipient->save();
        }

        return response()->json([
            'mailId' => $mail->id,
        ]);
    }
}
