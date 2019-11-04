<?php

namespace App\Http\Controllers;

use App\Conversations\OnboardingConversation;
use App\Services\FileCacheDriver;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\Psr6Cache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Illuminate\Support\Facades\Storage;
use App\Models\Mail;
use App\Models\Recipient;

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

        $file = $request->file('file');
        if(isset($file)){
            $newFilename = time() . str_random(5) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/images/'.$newFilename, file_get_contents($file));
            // $url = 'https://botman.io/img/logo.png';
            $url = secure_asset('storage/images/'.$newFilename);
            $attachment = new Image($url);
        }
          
        $users = $request->input('users', []);
        $message = $request->input('message', '');

        $newMail = new Mail;
        $newMail->message = $message;
        $newMail->image = 'images/'.$newFilename;
        $newMail->save();

        if(isset($attachment)){
            $message = OutgoingMessage::create($request->input('message', ''))
                    ->withAttachment($attachment); 
        }
          
        foreach($users as $userTelegramId) {
            $newRecipient = new Recipient;
            $newRecipient->mail_id = $newMail->id;
            $newRecipient->telegram_id = $userTelegramId;
            $newRecipient->save();
            $this->botman->say($message, $userTelegramId, TelegramDriver::class);
        }
    }
}
