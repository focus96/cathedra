<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class TelegramController extends Controller
{
    protected  $botman;

    protected $config = [
        "telegram" => [
            "token" => '769322022:AAF3OGog48cGB8llOWThuvf3iWfCjtGdLlU'
        ]
    ];

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $this->botman = BotManFactory::create($this->config);
    }

    public function send(Request $request) {
    	$attachment = new Image('https://botman.io/img/logo.png');
        $users = $request->input('users', []);
        // $message = $request->input('message', '');
        $message = OutgoingMessage::create($request->input('message', ''))
                ->withAttachment($attachment);

        foreach($users as $userTelegramId) {
            $this->botman->say($message, $userTelegramId, TelegramDriver::class);
        }
    }
}
