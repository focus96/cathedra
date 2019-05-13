<?php

namespace App\Http\Controllers;

use App\Conversations\DefaultConversation;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Cache\RedisCache;
use BotMan\BotMan\Storages\Storage;

class TelegramBotHearsController extends Controller
{
    protected $botman;

    protected $config = [
        "telegram" => [
            "token" => '636548977:AAF3TFV6jmYbSUxgyyW3PQbgjhVJ9gb7JUk'
        ]
    ];

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $this->botman = BotManFactory::create($this->config, new RedisCache('127.0.0.1', 6379));
    }

    public function hears () {
        $this->botman->hears('/start', function(BotMan $bot){
        	$bot->startConversation(new DefaultConversation);
        });
        $this->botman->listen();
    }

}
