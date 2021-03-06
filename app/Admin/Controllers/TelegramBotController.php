<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TelegramMail;
use App\Models\TelegramMailRecipient;
use App\Services\FileCacheDriver;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\Psr6Cache;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Exceptions\Base\BotManException;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\Drivers\Telegram\TelegramDriver;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TelegramBotController extends Controller
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

    public function index()
    {
        return Admin::content(function (Content $content) {

            // optional
            $content->header('Управление рассылками телеграм-бота');

            $content->description(' ');

            // Fill the page body part, you can put any renderable objects here
            $content->body(view('admin.telegram-bot.index'));
        });
    }

    public function send(Request $request)
    {

        $file = $request->file('file');
        $users = $request->input('users', []);
        $message = $request->input('message', '');

        $mail = new TelegramMail;
        $mail->message = $message;

        if (isset($file)) {
            $newFilename = time() . str_random(5) . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/images/' . $newFilename, file_get_contents($file));
            $url = secure_asset('storage/images/' . $newFilename);
            $attachment = new Image($url);
            // $mail->image = 'images/' . $newFilename;
        }

        $mail->save();

        if (isset($attachment)) {
            $message = OutgoingMessage::create($message)->withAttachment($attachment);
        }

        $delivered = 0;
        $undelivered = 0;

        foreach ($users as $userTelegramId) {
            $recipient = new TelegramMailRecipient;
            $recipient->mail_id = $mail->id;
            $recipient->telegram_id = $userTelegramId;

            try {
                $this->botman->say($message, $userTelegramId, TelegramDriver::class);
            } catch (BotManException $e) {
                $recipient->delivered = false;
                $recipient->save();
                $undelivered++;
                continue;
            }

            $recipient->delivered = true;
            $recipient->save();

            $delivered++;
        }

        return response()->json([
            'delivered' => $delivered,
            'undelivered' => $undelivered,
            'mailId' => $mail->id,
        ]);
    }

}
