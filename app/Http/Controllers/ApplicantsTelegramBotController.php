<?php

namespace App\Http\Controllers;

use App\Services\FileCacheDriver;
use App\Services\TelegramBot\ApplicantsConversation;
use App\Services\TelegramBot\StudentsConversation;
use App\Services\TelegramBot\TeachersConversation;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\Psr6Cache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;

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
            $bot->reply('/applicants - для абитуриентов');
            $bot->reply('/students - для студентов');
            $bot->reply('/teachers - для преподавателей');
        });

        $this->botman->hears('/applicants', function ($bot) {
            $bot->startConversation(new ApplicantsConversation());
        });

        $this->botman->hears('/students', function ($bot) {
            $bot->startConversation(new StudentsConversation());
        });

        $this->botman->hears('/teachers', function ($bot) {
            $bot->startConversation(new TeachersConversation());
        });

        $this->botman->hears('Выбор бота', function (BotMan $bot) {
            $bot->reply('/applicants - для абитуриентов');
            $bot->reply('/students - для студентов');
            $bot->reply('/teachers - для преподавателей');
        })->stopsConversation();

        $this->botman->fallback(function($bot) {
            $bot->reply('/applicants - для абитуриентов');
            $bot->reply('/students - для студентов');
            $bot->reply('/teachers - для преподавателей');
        });

        $this->botman->listen();
    }
}
