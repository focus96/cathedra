<?php

namespace App\Services\TelegramBot;

use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TelegramApplicantsFeedback;
use App\Models\TelegramBotApplicantsData;
use App\Models\TelegramBotVisitor;
use App\Models\TelegramStudentsFeedback;
use App\Models\Schedule;
use App\Traits\GroupCacheable;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class StudentsConversation extends Conversation
{
    const BOT_TYPE = 'students';

    protected $groupId;
    protected $student;

    public function run()
    {
        $this->handleFirstVisit();
        $this->handleExistsStudents();
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

    public function handleExistsStudents()
    {
        $user = $this->getBot()->getUser();
        $student = Student::where('telegram_id', $user->getId())->first();
        if ($student) {
            $this->student = $student;
            $this->say('Дрбро пожаловать, ' . $student->name);
            return true;
        } else {
            $this->say('Подтвердить ваш профиль. Сообщите свой ид администратору системы. Ваш ид - ' . $user->getId());
        }

        return false;

    }

    public function askAction()
    {
        $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard()
            ->addRow(KeyboardButton::create('Подскажи мое рассписание')->callbackData('datesSchedule'),
                KeyboardButton::create('Когда будет преподаватель?')->callbackData('whenTeacher'))
            ->addRow(KeyboardButton::create('Какая сейчас неделя (|,*)?')->callbackData('whatWeek'),
                KeyboardButton::create('Как зовут преподавателей?)')->callbackData('whatNamesTeachers'))
            ->addRow(KeyboardButton::create("Задать вопрос"), KeyboardButton::create("Выбор бота"));

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
                case 'Как зовут преподавателей?)':
                    $this->whatNamesTeachers();
                    break;
                case 'Задать вопрос':
                    $this->question();
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
                KeyboardButton::create(date('d-m', strtotime('1 weekdays'))),
                KeyboardButton::create(date('d-m', strtotime('2 weekdays'))),
                KeyboardButton::create(date('d-m', strtotime('3 weekdays'))),
                KeyboardButton::create(date('d-m', strtotime('4 weekdays'))));
        $keyboard = $this->setDefaultButtons($keyboard);

        $this->ask('Выбери день недели или дату:', function (Answer $answer) {
            $userText = $answer->getText();
            $idWeekDay = false;

            // Проверяем, может сегодня выходной.
            if ($userText === 'Сегодня' && date('N', strtotime('today')) >= 6) {
                $this->say('Сегодня выходной, отдыхай)');
            }


            if (!$this->student) {
                $this->askGroup();
                return;
            } else {
                $this->groupId = $this->student->groups_id;
            }

            $rusShortDaysOfWeek = ['Пн' => 1, 'Вт' => 2, 'Ср' => 3, 'Чт' => 4, 'Пт' => 5];
            $dayNumber = null;

            if (array_key_exists($userText, $rusShortDaysOfWeek)) {
                $dayNumber = $rusShortDaysOfWeek[$userText];
                $idWeekDay = true;
            } elseif ($userText === 'Сегодня') {
                $dayNumber = date('N', strtotime('today'));
            } else {
                $dayNumber = date('N', strtotime($userText . '.' . Date('Y', strtotime('today'))));
            }

            $schedule = Schedule::whereGroupId($this->groupId)
                ->where('day', $dayNumber)
                ->with(['teacher', 'item'])
                ->orderBy('couple_number', 'asc')
                ->get();


            $message = '';
            if (count($schedule)) {
                $types = ['laboratory_work' => 'лабораторна работа', 'practical_lesson' => 'практичне заняття', 'lecture' => 'лекція'];

                // Групируем по номеру пары
                $schedule = $schedule->groupBy('couple_number');
                // Проходимся по каждому номер парі
                foreach ($schedule as $coupleNumber => $scheduleItemsByCouple) {
                    // проходимся по каждому предмету, тк их может быть два чет \ нечет
                    foreach ($scheduleItemsByCouple as $item) {
                        // берем текучую четность недели
                        $partyWeek = $this->getPartyWeek();



                        // если указана четность в распсании и если совпадает с четностью предмета - добавляем в сообщение
                        if ($idWeekDay || !$item->party_week || ($item->party_week && $item->party_week === $partyWeek)) {
                            $message .= "{$item->couple_number}: " . ($item->item ? $item->item->abbreviation : '-') . ' ' . ($item->parity_week ?  ($item->parity_week === 'even' ? '*' : '|') : '') . ', ' .
                                ($item->lecture_hall ? $item->lecture_hall : '-') . '. ' .
                                ($item->teacher ? $item->teacher->fio : '-') . ', ' .
                                (array_key_exists($item->type, $types) ? $types[$item->type] : '-') . PHP_EOL;
                        }
                    }
                }
            } else {
                $message = 'Мы еще не заполнили расписание на этот день, обратись с этим вопросом на кафедру';
            }

            $this->say($message);
            $this->askAction();
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

        foreach ($groupsBySpecializations as $groupsBySpecialization) {
            $buttons = [];

            foreach ($groupsBySpecialization as $group) {
                $buttons[] = KeyboardButton::create("{$group->name}");
            }

            $keyboard->addRow(...$buttons);
        }
        $keyboard = $this->setDefaultButtons($keyboard);

        $this->ask('Пожалуйста, выбери свою группу или подтверди телеграм ид', function (Answer $answer) {
            $this->groupId = (new GroupCacheable())->getGroupIdByGroupName($answer->getText());
            $this->say('Спасибо, теперь я смогу тебе ответить!');
            $this->askAction();
        }, $keyboard->toArray());
    }

    protected function whatWeek()
    {
        $parties = [
            'odd' => '|',
            'even' => '*',
        ];
        $this->say("Текущая неделя: {$parties[$this->getPartyWeek()]}");
        $this->askAction();
    }

    public function stopsConversation(IncomingMessage $message)
    {
        if ($message->getText() == '/applicants' || $message->getText() == '/students' || $message->getText() == '/teachers') {
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

            TelegramStudentsFeedback::create([
                'telegram_id' => $userId,
                'question' => $userText
            ]);

            $this->say("Спасибо за вопрос, мы подготовим ответ и я пришлю тебе его в этот же чат");
            $this->askAction();
        }, $keyboard->toArray());
    }

    protected function checkDefaultButtons(Answer $answer)
    {
        $userText = $answer->getText();
        if ($userText === 'Главное меню') {
            $this->askAction();
            return true;
        } elseif ($userText === 'Задать вопрос') {
            $this->question();
            return true;
        }

        return false;

    }

    protected function setDefaultButtons(Keyboard $keyboard)
    {
        return $keyboard->addRow(KeyboardButton::create("Главное меню"), KeyboardButton::create("Выбор бота"));
    }

    public function whatNamesTeachers()
    {
        $teachers = Teacher::where('cathedra_id', 1)->get();

        $message = 'Список преподавателй кафедры АВП:' . PHP_EOL;
        foreach ($teachers as $teacher) {
            $message .= $teacher->surname . ' ' . $teacher->name . $teacher->last_name . PHP_EOL;
        }

        $this->say($message);
        $this->askAction();

    }

    protected function getPartyWeek()
    {
        $currentWeekNumber = date('W');
        $settings = get_settings();

        if (($currentWeekNumber - $settings->party_week_number) % 2 == 0) {
            return $settings->party_week;
        } else {
            return $settings->party_week === 'odd' ? 'even' : 'odd';
        }
    }

    protected function whenTeacher()
    {
        // спросить учителя
        $teachers = Teacher::where('cathedra_id', 1)->get();
        $message = 'Выбери преподавателя:' . PHP_EOL;
        foreach ($teachers as $teacher) {
            $message .= '/' . $teacher->id . ' - ' .  $teacher->surname . ' ' . $teacher->name . $teacher->last_name . PHP_EOL;
        }

        $this->ask($message, function (Answer $answer) {
            $userText = $answer->getText();
            $teacherId = (int)str_replace('/', '', $userText);

            $keyboard = Keyboard::create(Keyboard::TYPE_KEYBOARD)->oneTimeKeyboard()
                ->addRow(KeyboardButton::create('Пн'),
                    KeyboardButton::create('Вт'),
                    KeyboardButton::create('Ср'),
                    KeyboardButton::create('Чт'),
                    KeyboardButton::create('Пт'))
                ->addRow(KeyboardButton::create('Сегодня'),
                    KeyboardButton::create(date('d-m', strtotime('1 weekdays'))),
                    KeyboardButton::create(date('d-m', strtotime('2 weekdays'))),
                    KeyboardButton::create(date('d-m', strtotime('3 weekdays'))),
                    KeyboardButton::create(date('d-m', strtotime('4 weekdays'))));
            $keyboard = $this->setDefaultButtons($keyboard);

            $this->ask('Выбери день недели или дату:', function (Answer $answer) use ($teacherId) {
                $userText = $answer->getText();
                $idWeekDay = false;
                // Проверяем, может сегодня выходной.
                if ($userText === 'Сегодня' && date('N', strtotime('today')) >= 6) {
                    $this->say('Сегодня выходной, все отдыхают)');
                }

                $rusShortDaysOfWeek = ['Пн' => 1, 'Вт' => 2, 'Ср' => 3, 'Чт' => 4, 'Пт' => 5];
                $dayNumber = null;

                if (array_key_exists($userText, $rusShortDaysOfWeek)) {
                    $idWeekDay = true;
                    $dayNumber = $rusShortDaysOfWeek[$userText];
                } elseif ($userText === 'Сегодня') {
                    $dayNumber = date('N', strtotime('today'));
                } else {
                    $dayNumber = date('N', strtotime($userText . '.' . Date('Y', strtotime('today'))));
                }

                $schedule = Schedule::whereTeacherId($teacherId)
                    ->where('day', $dayNumber)
                    ->with(['group', 'item'])
                    ->orderBy('couple_number', 'asc')
                    ->get();


                $message = '';
                if (count($schedule)) {
                    $types = ['laboratory_work' => 'лабораторна работа', 'practical_lesson' => 'практичне заняття', 'lecture' => 'лекція'];

                    // Групируем по номеру пары
                    $schedule = $schedule->groupBy('couple_number');
                    // Проходимся по каждому номер парі
                    foreach ($schedule as $coupleNumber => $scheduleItemsByCouple) {
                        // проходимся по каждому предмету, тк их может быть два чет \ нечет
                        foreach ($scheduleItemsByCouple as $item) {
                            // берем текучую четность недели
                            $partyWeek = $this->getPartyWeek();

                            // если указана четность в распсании и если совпадает с четностью предмета - добавляем в сообщение
                            if ($idWeekDay = true || !$item->party_week || ($item->party_week && $item->party_week === $partyWeek)) {
                                $message .= "{$item->couple_number}: " . ($item->item ? $item->item->abbreviation : '-') . ' ' . ($item->parity_week ?  ($item->parity_week === 'even' ? '*' : '|') : '') . ', ' .
                                    ($item->lecture_hall ? $item->lecture_hall : '-') . ', ' .
                                    ($item->group ? $item->group->name : '-') . ', ' .
                                    (array_key_exists($item->type, $types) ? $types[$item->type] : '-') . PHP_EOL;
                            }
                        }
                    }
                } else {
                    $message = 'Мы еще не заполнили расписание на этот день, обратись с этим вопросом на кафедру';
                }

                $this->say($message);
                $this->askAction();
            }, $keyboard->toArray());
        });

        // спросить день недели
        // вывести расписание
    }
}
