<?php

namespace App\Http\Controllers;

use App\Conversations\OnboardingConversation;
use App\Models\TelegramMail;
use App\Services\FileCacheDriver;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\Psr6Cache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Exceptions\Base\BotManException;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Illuminate\Support\Facades\Storage;
use App\Models\Mail;
use App\Models\TelegramMailRecipient;

class TelegramBotController extends Controller
{
    protected $botman;

    protected $config = [
        "telegram" => [
            "token" => '705199406:AAH9XWBdk0OofJj4yinG4d1Ia4G2X8_89ok'
        ]
    ];

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $adapter = new FileCacheDriver();
        $this->botman = BotManFactory::create($this->config, new Psr6Cache($adapter));
    }

    public function send(Request $request) {

//        $file = $request->file('file');
//        $users = $request->input('users', []);
//        $message = $request->input('message', '');
//
//        $mail = new TelegramMail;
//        $mail->message = $message;
//
//        if(isset($file)){
//            $newFilename = time() . str_random(5) . '.' . $file->getClientOriginalExtension();
//            Storage::disk('local')->put('public/images/'.$newFilename, file_get_contents($file));
//            $url = secure_asset('storage/images/'.$newFilename);
//            $attachment = new Image($url);
//            $mail->image = 'images/'.$newFilename;
//        }
//
//        $mail->save();
//
//        if(isset($attachment)) {
//            $message = OutgoingMessage::create($message)->withAttachment($attachment);
//        }
//
//        $delivered = 0;
//        $undelivered = 0;
//
//        foreach($users as $userTelegramId) {
//            $recipient = new TelegramMailRecipient;
//            $recipient->mail_id = $mail->id;
//            $recipient->telegram_id = $userTelegramId;
//
//            try {
////                $this->botman->say($message, $userTelegramId, TelegramDriver::class);
//            } catch (BotManException $e) {
//                $recipient->delivered = false;
//                $recipient->save();
//                $undelivered++;
//                continue;
//            }
//
//            $recipient->delivered = true;
//            $recipient->save();
//
//            $delivered++;
//        }
//
//        return response()->json([
//            'delivered' => $delivered,
//            'undelivered' => $undelivered,
//            'mailId' => $mail->id,
//        ]);
    }
}
