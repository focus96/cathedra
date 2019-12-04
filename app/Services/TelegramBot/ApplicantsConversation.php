<?php

namespace App\Services\TelegramBot;

use App\Models\Group;
use App\Models\Student;
use App\Models\TelegramApplicantsFeedback;
use App\Models\TelegramBotApplicantsData;
use App\Models\TelegramBotVisitor;
use App\Schedule;
use App\Traits\GroupCacheable;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class ApplicantsConversation extends Conversation
{
    const BOT_TYPE = 'applicants';

    protected $groupId;

    public function run()
    {
        $this->handleFirstVisit();
        $this->askApplicants();
    }

    public function handleFirstVisit()
    {
        $user = $this->getBot()->getUser();
        if (!TelegramBotVisitor::whereBotType(self::BOT_TYPE)->whereTelegramId($user->getId())->exists()) {
            $this->say('Привет! Я телеграм бот для аббитуриентов кафедры АПП.');
            TelegramBotVisitor::create([
                'bot_type' => self::BOT_TYPE,
                'telegram_id' => $user->getId(),
                'user_name' => $user->getUsername(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
            ]);
        }
    }

    protected function askApplicants()
    {
        // Разделы информации для бота
        $datas = TelegramBotApplicantsData::whereNull('parent_id')->get();

        $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard();

        // Формируем клавиатуру в два столбца
        $buttons = [];
        foreach ($datas as $data) {

            $buttons[] = KeyboardButton::create("{$data->title}");

            if (count($buttons) >= 2) {
                $keyboard->addRow(...$buttons);
                $buttons = [];
            }
        }

        // Если остались не добавленные пункты - добавляем их
        if (count($buttons)) {
            $keyboard->addRow(...$buttons);
        }

        // Добавляем пункт задать вопрос
        $keyboard->addRow(KeyboardButton::create("Задать вопрос"));

        // Спрашиваем чем можем помочь, используя сформированную клавиатуру
        $this->ask('Чем я могу тебе помочь?', function (Answer $answer) {
            if ($this->checkDefaultButtons($answer)) {
                return;
            };
            $this->childData($answer);
        }, $keyboard->toArray());
    }

    protected function childData($answer)
    {
        $userText = $answer->getText();

        // Получаем пункт меню по заголовку
        $telegramBotApplicantsData = TelegramBotApplicantsData::where('title', $userText)->first();

        if (!$telegramBotApplicantsData) {
            $this->unknownAnswer();
            return;
        }

        if ($telegramBotApplicantsData->content) {
            $question = $telegramBotApplicantsData->content;
        } else {
            $question = $telegramBotApplicantsData->title . ':';
        }

        // Получаем дочерние элементы
        $telegramBotApplicantsDataList = TelegramBotApplicantsData::where('parent_id', $telegramBotApplicantsData->id)->get();
        // если нет дочерких елементов, выводим предыдущее меню
        if (!count($telegramBotApplicantsDataList)) {
            $telegramBotApplicantsDataList = TelegramBotApplicantsData::where('parent_id', $telegramBotApplicantsData->parent_id)->get();
        }

        // Создаем клавиатуру по тому же принципу
        $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard();

        $buttons = [];
        foreach ($telegramBotApplicantsDataList as $data) {
            $buttons[] = KeyboardButton::create("{$data->title}");

            if (count($buttons) >= 2) {
                $keyboard->addRow(...$buttons);
                $buttons = [];
            }
        }

        if (count($buttons)) {
            $keyboard->addRow(...$buttons);
        }

        // ДОбавляем главное меню
        $keyboard = $this->setDefaultButtons($keyboard);

        // Выводим овтет с клавиатурой
        $this->ask($question, function (Answer $answer) {
            if ($this->checkDefaultButtons($answer)) {
                return;
            };
            $this->childData($answer);
        }, $keyboard->toArray());
    }

    protected function setDefaultButtons(Keyboard $keyboard)
    {
        return $keyboard->addRow(KeyboardButton::create("Главное меню"));
    }

    protected function checkDefaultButtons(Answer $answer)
    {
        $userText = $answer->getText();
        if ($userText === 'Главное меню') {
            $this->askApplicants();
            return true;
        } elseif ($userText === 'Задать вопрос') {
            $this->question();
            return true;
        }

        return false;

    }

    protected function question()
    {
        $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard();
        $keyboard = $this->setDefaultButtons($keyboard);
        $this->ask('Просто напиши мне свой вопрос)', function (Answer $answer) {
            if ($this->checkDefaultButtons($answer)) {
                return;
            };
            $userText = $answer->getText();
            $user = $this->getBot()->getUser();
            $userId = $user->getId();

            TelegramApplicantsFeedback::create([
                'telegram_id' => $userId,
                'question' => $userText
            ]);

            $this->say("Спасибо за вопрос, мы подготовим ответ и я пришлю тебе его в этот же чат");
            $this->askApplicants();
        }, $keyboard->toArray());
    }

    public function notInteractiveReply()
    {
        $this->say('Давай будем общаться с помощью интрактивных кнопок, так мне будет легче тебя понять)');
        $this->askApplicants();
    }

    public function unknownAnswer()
    {
        $this->say('Упс..( Затрудняюсь ответить на это. Попробуй воспользоваться встроенной клавиатурой');
        $this->askApplicants();
    }
}
