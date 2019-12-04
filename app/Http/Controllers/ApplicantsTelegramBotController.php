<?php

namespace App\Http\Controllers;

use App\Services\FileCacheDriver;
use App\Services\TelegramBot\ApplicantsConversation;
use App\Services\TelegramBot\StudentsConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\Psr6Cache;
use BotMan\BotMan\Cache\RedisCache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;

class ApplicantsTelegramBotController extends Controller
{
    protected $botman;

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $adapter = new FileCacheDriver();
        $this->botman = BotManFactory::create($this->getConfig(), new Psr6Cache($adapter));
    }

    public function getConfig()
    {
        return [
            "telegram" => config('bot.telegram.applicants')
        ];
    }

    public function hears () {
        $this->botman->hears('/start', function ($bot) {
            $bot->startConversation(new ApplicantsConversation());
        });

        $this->botman->listen();
    }
}
