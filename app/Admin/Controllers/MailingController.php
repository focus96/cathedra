<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Mailing;
use App\Models\EmailRecipient;
use App\Models\Mail;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as MailFacade;

class MailingController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Управление email-рассылками');
            $content->description(' ');
            $content->body(view('admin.mailing.index'));
        });
    }

    public function send(Request $request) {

        $users = $request->input('users', []);
        $message = $request->input('message', '');

        $mail = new Mail;
        $mail->message = $message;
        $mail->save();

        ini_set('max_execution_time', 600);
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
