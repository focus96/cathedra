<?php

namespace App\Conversations;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Storages\Storage;
use App\Models\Applicant;
use App\Models\UserQuestion;

class DefaultConversation extends Conversation
{
	
	protected $firstname;
    protected $city;
    protected $work;

    public function askFirstname()
    {
        $this->ask('Привет! Я о тебе ничего не знаю, давай познакомимся! Как тебя зовут?', function(Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();
            $this->say('Приятно познакомиться, '.$this->firstname);
            $this->bot->userStorage()->save([
                    'name' => $answer->getText(),
                ]);
            $this->askCity();
        });
    }

    public function askCity()
    {
    	$question = Question::create('Чтобы я смог лучше тебе помочь по вопросам поступления к нам на кафедру, расскажи, пожалуйста, немного о себе. С какого ты города?')
	        ->addButtons([
	            Button::create('Краматорск')->value('Краматорск'),
	            Button::create('Славянск')->value('Славянск'),
	            Button::create('Дружковка')->value('Дружковка'),
	            Button::create('Другой')->value('Другой'),
	        ]);

        $this->ask($question, function (Answer $answer) {
	        // Detect if button was clicked:
	        if ($answer->isInteractiveMessageReply()) {
	        	switch ($answer->getValue()) {
	        		case 'Краматорск':
	        		case 'Славянск':
	        		case 'Дружковка':
	        			$this->bot->userStorage()->save([
			                    'city' => $answer->getValue(),
			                ]);
	        			$this->askWork();
	        		break;
	            	case 'Другой':
		            	$this->ask('Из какого же ты города?', function (Answer $answer) {
		            		$this->bot->userStorage()->save([
			                    'city' => $answer->getText(),
			                ]);
			                $this->askWork();
		            	});
	            	break;
	            }  
	        }
	    });      
    }

    public function askWork()
    {
    	$this->ask('Круто! И последнее, напиши, пожалуйста, где ты сейчас учишься или работаешь', function(Answer $answer) {
    		$this->work = $answer->getText();
    		$this->bot->userStorage()->save([
                    'work' => $answer->getText(),
                ]);
    		$this->saveUser();
    		$this->askInfo();
    	});
    }

    public function run()
    {
        // This will be called immediately
        $this->askFirstname();
    }

    public function askInfo()
    {
        $question = Question::create('Какую информацию хотите узнать?')
        ->addButtons([
            Button::create('О кафедре')->value('cathedra'),
            Button::create('Вступительная кампания')->value('programm'),
            Button::create('Обратная связь')->value('feedback'),
            Button::create('Выход')->value('exit'),
        ]);

        $this->ask($question, function (Answer $answer) {            
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 'cathedra':
                    $question = Question::create('О кафедре:')
                    ->addButtons([
                        Button::create('Материальная база')->value('material'),
                        Button::create('Состав')->value('consist'),
                        Button::create('История')->value('history'),
                    ]);

                    $this->ask($question, function (Answer $answer) {            
                        // Detect if button was clicked:
                        if ($answer->isInteractiveMessageReply()) {
                            switch ($answer->getValue()) {
                                case 'material':
                                    $this->say('Материальная база');
                                    $this->askInfo();
                                break;
                                case 'consist':
                                    $this->say('Состав');
                                    $this->askInfo();
                                break;
                                case 'history':
                                    $this->say('История');
                                    $this->askInfo();
                                break;
                            }
                        }
                    });
                    break;
                    case 'programm':
                        $question = Question::create('Вступительная компания:')
                    ->addButtons([
                        Button::create('Бакалавр')->value('bacherol'),
                        Button::create('Бакалавр ускор.')->value('bacherol accelerate'),
                        Button::create('Магистр')->value('master'),
                        Button::create('Аспирантура')->value('graduate'),
                    ]);

                    $this->ask($question, function (Answer $answer) {            
                        // Detect if button was clicked:
                        if ($answer->isInteractiveMessageReply()) {
                            switch ($answer->getValue()) {
                                case 'bacherol':
                                    $this->say('Бакалавр');
                                    $this->askInfo();
                                break;
                                case 'bacherol accelerate':
                                    $this->say('Бакалавр ускор.');
                                    $this->askInfo();
                                break;
                                case 'master':
                                    $this->say('Магистр');
                                    $this->askInfo();
                                break;
                                case 'graduate':
                                    $this->say('Аспирантура');
                                    $this->askInfo();
                                break;
                            }
                        }
                    });
                    break;
                    case 'feedback':
                        $this->ask('Напишите свой вопрос, а мы в скором времени ответим на него', function(Answer $answer) {
                        // Save result
                        $this->feedback = $answer->getText();
                        $this->bot->userStorage()->save([
                            'feedback' => $answer->getText(),
                        ]);
                        $this->bye();
                    });
                    break;
                    case 'exit':
                        $this->say('До встречи');
                    break;
                }
            }
        });    
    }

    public function bye()
    {
        $this->say('Спасибо! Ожидайте ответа.');
        $this->saveQuestion();
    }

    public function saveUser()
    {
    	$user = $this->bot->userStorage()->find();
    	$userInfo = $this->bot->getUser();
    	$newApplicant = new Applicant;
        $newApplicant->telegram_name = $userInfo->getFirstName();
        $newApplicant->name = $user->get('name');
        $newApplicant->city = $user->get('city');
        $newApplicant->occupation = $user->get('work');
        $newApplicant->telegram_id = $userInfo->getId();
    	$newApplicant->save();
    }

    public function saveQuestion()
    {
        $user = $this->bot->userStorage()->find();
        $userInfo = $this->bot->getUser();
        $questionUser = new UserQuestion;
        $questionUser->name = $user->get('name');
        $questionUser->question = $user->get('feedback');
        $questionUser->telegram_id = $userInfo->getId();
        $questionUser->save();
    }

}

