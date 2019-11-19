<?php

namespace App\Services\TelegramBot;

use App\Models\Group;
use App\Models\Student;
use App\Models\TelegramBotVisitor;
use App\Schedule;
use App\Traits\GroupCacheable;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class StudentsConversation extends Conversation
{
    const BOT_TYPE = 'students';

    protected $groupId;

    public function run()
    {
        $this->handleFirstVisit();
        $this->askAction();
    }

    public function handleFirstVisit()
    {
        $user = $this->getBot()->getUser();
        if (!TelegramBotVisitor::whereBotType(self::BOT_TYPE)->whereTelegramId($user->getId())->exists()) {
            $this->say(__('messages.php.students.first-visit'));
            TelegramBotVisitor::create([
                'bot_type' => self::BOT_TYPE,
                'telegram_id' => $user->getId(),
                'user_name' => $user->getUsername(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
            ]);
        }
    }

    public function askAction()
    {
        $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard()
            ->addRow(KeyboardButton::create('Подскажи мое рассписание')->callbackData('datesSchedule'),
                KeyboardButton::create('Когда будет преподаватель?')->callbackData('whenTeacher'))
            ->addRow(KeyboardButton::create('Какая сейчас неделя (|,*)?')->callbackData('whatWeek'),
                KeyboardButton::create('Как зовут преподавателей?)?')->callbackData('whatNamesTeachers'));

        $this->ask('Как я могу тебе помочь?)', function (Answer $answer) {
            $userText = $answer->getText();

            switch ($userText) {
                case 'Подскажи мое рассписание':
                    $this->datesSchedule();
                    break;
                case 'Когда будет преподаватель?':
                    $this->whenTeacher();
                    break;
                case 'Какая сейчас неделя (|,*)?':
                    $this->whatWeek();
                    break;
                case 'Как зовут преподавателей?)?':
                    $this->whatNamesTeachers();
                    break;
                default:
                    $this->unknownAnswer();
            }
        }, $keyboard->toArray());
    }

    public function datesSchedule()
    {
        $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard()
            ->addRow(KeyboardButton::create('Пн'),
                KeyboardButton::create('Вт'),
                KeyboardButton::create('Ср'),
                KeyboardButton::create('Чт'),
                KeyboardButton::create('Пт'))
            ->addRow(KeyboardButton::create('Сегодня'),
                KeyboardButton::create(date ( 'd-m' , strtotime ( '1 weekdays' ) )),
                KeyboardButton::create(date ( 'd-m' , strtotime ( '2 weekdays' ) )),
                KeyboardButton::create(date ( 'd-m' , strtotime ( '3 weekdays' ) )),
                KeyboardButton::create(date ( 'd-m' , strtotime ( '4 weekdays' ) )));

        $this->ask('Выбери день недели или дату:', function (Answer $answer) {
            $userText = $answer->getText();

            // Проверяем, может сегодня выходной.
            if($userText === 'Сегодня' && date('N', strtotime('today')) >= 6) {
                    $this->say('Сегодня выходной, отдыхай)');
            }

            // Необходимо получить ид группы для того, чтобы отобразить расспивание;
            $this->groupId = 1;
            if(!$this->groupId) {
                // Пытаемся выделаить ученика по телеграм ид
                $student = Student::whereTelegramId($this->getBot()->getUser()->getId())->first();
                if(!$student) {
                    $this->askGroup();
                    return;
                }
                $this->groupId = $student->group_id;
            }

            $rusShortDaysOfWeek = ['Пн' => 1, 'Вт' => 2, 'Ср' => 3, 'Чт' => 4, 'Пт' => 5];
            $dayNumber = null;

            if(array_key_exists($userText, $rusShortDaysOfWeek)) {
                $dayNumber = $rusShortDaysOfWeek[$userText];
            }elseif($userText === 'Сегодня') {
                $dayNumber = date('N', strtotime('today'));
            }else {
                $dayNumber = date('N', strtotime($userText . '.' . Date('Y', strtotime('today'))));
            }

            $schedule = Schedule::whereGroupId($this->groupId)->where('day', $dayNumber)->with(['teacher', 'item'])->orderBy('couple_number', 'asc')->get();

            $message = '';

            foreach($schedule as $item) {
                $message .= "{$item->couple_number}: {$item->item->name}";
            }

            $this->say($message);
        }, $keyboard->toArray());
    }

    public function notInteractiveReply()
    {
        $this->say('Давай будем общаться с помощью интрактивных кнопок, так мне будет легче тебя понять)');
        $this->askAction();
    }

    public function unknownAnswer()
    {
        $this->say('Упс..( Затрудняюсь ответить на это. Попробуй воспользоваться встроенной клавиатурой');
        $this->askAction();
    }

    public function askGroup()
    {
        $groupsBySpecializations = Group::all()->groupBy('specialization_id');

        $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard();

        foreach($groupsBySpecializations as $groupsBySpecialization) {
            $buttons = [];

            foreach($groupsBySpecialization as $group) {
                $buttons[] = KeyboardButton::create("{$group->name}");
            }

            $keyboard->addRow(...$buttons);
        }

        $this->ask('Пожалуйста, выбери свою группу или подтверди телеграм ид', function (Answer $answer) {
            $this->groupId = (new GroupCacheable())->getGroupIdByGroupName($answer->getText());
            $this->say('Спасибо, теперь я смогу тебе ответить!');
            $this->askAction();
        }, $keyboard->toArray());
    }
}