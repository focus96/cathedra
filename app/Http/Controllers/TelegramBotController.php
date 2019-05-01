<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;

class TelegramBotController extends Controller
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
        $users = $request->input('users', []);
        $message = $request->input('message', '');

        foreach($users as $userTelegramId) {
            $this->botman->say($message, $userTelegramId, TelegramDriver::class);
        }
    }
}
