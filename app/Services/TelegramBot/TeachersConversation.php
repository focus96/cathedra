<?php

namespace App\Services\TelegramBot;

use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TelegramApplicantsFeedback;
use App\Models\TelegramBotApplicantsData;
use App\Models\TelegramBotTeachersData;
use App\Models\TelegramBotVisitor;
use App\Schedule;
use App\Traits\GroupCacheable;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;
use Illuminate\Support\Facades\Log;

class TeachersConversation extends Conversation
{
    const BOT_TYPE = 'teachers';

    protected  $teacher;

    public function run()
    {
        $this->handleFirstVisit();
        if($this->handleExistsTeacher()) {
            $this->askApplicants();
        }

        return;
    }

    public function handleFirstVisit()
    {
        $user = $this->getBot()->getUser();
        if (!TelegramBotVisitor::whereBotType(self::BOT_TYPE)->whereTelegramId($user->getId())->exists()) {
            $this->say('Привет! Я телеграм бот для преподавателей кафедры АПП.');
            TelegramBotVisitor::create([
                'bot_type' => self::BOT_TYPE,
                'telegram_id' => $user->getId(),
                'user_name' => $user->getUsername(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
            ]);
        }
    }

    public function handleExistsTeacher()
    {
        $user = $this->getBot()->getUser();
        $teacher = Teacher::where('telegram_id', $user->getId())->first();
        if($teacher) {
            $this->teacher = $teacher;
            $this->say('Дрбро пожаловать, ' . $teacher->name . ' ' . $teacher->last_name);
            return true;
        }else {
            $this->say('Доступ ограничено. Необходимо подтвердить ваш профиль. Сообщите свой ид администратору системы. Ваш ид - ' . $user->getId());
            $this->say('/applicants - для абитуриентов');
            $this->say('/students - для студентов');
            $this->say('/teachers - для преподавателей');
        }

        return false;
    }

    protected function askApplicants()
    {
        // Разделы информации для бота
        $datas = TelegramBotTeachersData::whereNull('parent_id')->get();

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
        $keyboard->addRow(KeyboardButton::create("Выбор бота"));

        // Спрашиваем чем можем помочь, используя сформированную клавиатуру
        $this->ask('Чем я могу Вам помочь?', function (Answer $answer) {
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
        $telegramBotApplicantsData = TelegramBotTeachersData::where('title', $userText)->first();

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
        $telegramBotApplicantsDataList = TelegramBotTeachersData::where('parent_id', $telegramBotApplicantsData->id)->get();
        // если нет дочерких елементов, выводим предыдущее меню
        if (!count($telegramBotApplicantsDataList)) {
            $telegramBotApplicantsDataList = TelegramBotTeachersData::where('parent_id', $telegramBotApplicantsData->parent_id)->get();
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
        return $keyboard->addRow(KeyboardButton::create("Главное меню"), KeyboardButton::create("Выбор бота"));
    }

    protected function checkDefaultButtons(Answer $answer)
    {
        $userText = $answer->getText();
        if ($userText === 'Главное меню') {
            $this->askApplicants();
            return true;
        }

        return false;

    }

    public function notInteractiveReply()
    {
        $this->say('Давайте будем общаться с помощью интрактивных кнопок, так мне будет легче Вас понять)');
        $this->askApplicants();
    }

    public function unknownAnswer()
    {
        $this->say('Упс..( Затрудняюсь ответить на это. Попробуйте воспользоваться встроенной клавиатурой');
        $this->askApplicants();
    }

    public function stopsConversation(IncomingMessage $message)
    {
        if ($message->getText() == '/applicants' || $message->getText() == '/students' || $message->getText() == '/teachers') {
            return true;
        }

        return false;
    }
}
