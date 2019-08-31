<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailSubscriberRequest;
use App\Mail\ConfirmSubscribe;
use App\Models\EmailSubscriber;
use Illuminate\Support\Facades\Mail;

class EmailSubscriberController extends Controller
{
    public function subscribe(EmailSubscriberRequest $request)
    {
        $email = $request->only('email');
        $subscribeEmail = EmailSubscriber::whereEmail($email)->first();

        if($subscribeEmail) {
            return response()->json([
                'status' => 'already_exists',
                'is_confirm' => $subscribeEmail->is_confirm
            ]);
        }else {
            $subscribeEmail = EmailSubscriber::create($email);
            Mail::to($email)->send(new ConfirmSubscribe($subscribeEmail));

            return response()->json([
                'status' => 'created',
                'is_confirm' => false
            ]);
        }
    }

    public function confirm(EmailSubscriber $subscribeEmail)
    {
        if($subscribeEmail->confirm_token === request()->get('confirm_token')) {
            $subscribeEmail->is_confirm = true;
            $subscribeEmail->save();
        }

        return view('subscribe-confirm', [
            'confirm' => $subscribeEmail->is_confirm,
        ]);
    }

    public function resend(EmailSubscriberRequest $request)
    {
        $email = $request->only('email');
        $subscribeEmail = EmailSubscriber::whereEmail($email)->first();
        Mail::to($email)->send(new ConfirmSubscribe($subscribeEmail));

        return response()->json([
            'status' => 'success',
        ]);
    }
}
