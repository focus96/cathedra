<?php

namespace App\Http\Controllers;

use App\Services\TelegramBot\StudentsConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\RedisCache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;

class StudentsTelegramBotController extends Controller
{
    protected $botman;

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $this->botman = BotManFactory::create($this->getConfig(), new RedisCache('127.0.0.1', 6379));
    }

    public function getConfig()
    {
        return [
            "telegram" => config('bot.telegram.students')
        ];
    }

    public function hears () {
        $this->botman->hears('hi', function ($bot) {
            $bot->startConversation(new StudentsConversation);
        });

        $this->botman->listen();
    }
}
