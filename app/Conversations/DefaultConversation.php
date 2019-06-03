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
use App\Models\CathedraInfo;
use App\Models\Bachelor;
use App\Models\BachelorAccelerated;
use App\Models\Master;
use App\Models\Postgraduate;
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
                        $cathedraInfo = CathedraInfo::where('active', '=', 1)->get();
                        $buttonArray = [];
                    
                        foreach ($cathedraInfo as $value) {
                            $button = Button::create($value->caption)->value($value->id);
                            $buttonArray[] = $button;
                        }

                        $back = Button::create('Назад')->value('back');
                        $buttonArray[] = $back;

                        $question = Question::create('О кафедре:')->addButtons($buttonArray);

                        $this->ask($question, function (Answer $answer) {
                            if ($answer->isInteractiveMessageReply()) {
                                $cathedraId = CathedraInfo::where('id', '=', $answer->getValue())->first();
                                if($answer->getValue() === 'back') {                         
                                    $this->askInfo();                                    
                                } else {
                                    $this->say($cathedraId->answer);
                                    $this->askInfo();                                    
                                }
                            }
                        }); 
                    break;
                    case 'programm':
                        $question = Question::create('Вступительная компания:')
                    ->addButtons([
                        Button::create('Бакалавр')->value('bacherol'),
                        Button::create('Бакалавр ускор.')->value('accelerate'),
                        Button::create('Магистр')->value('master'),
                        Button::create('Аспирантура')->value('graduate'),
                        Button::create('Назад')->value('back'),
                    ]);

                    $this->ask($question, function (Answer $answer) {            
                        // Detect if button was clicked:
                        if ($answer->isInteractiveMessageReply()) {
                            switch ($answer->getValue()) {
                                case 'bacherol':
                                    $bachelorInfo = Bachelor::where('is_public', '=', 1)->get();
                                    $buttonArray = [];
                                
                                    foreach ($bachelorInfo as $value) {
                                        $button = Button::create($value->title)->value($value->id);
                                        $buttonArray[] = $button;                                        
                                    }

                                    $back = Button::create('Назад')->value('back');
                                    $buttonArray[] = $back;

                                    $question = Question::create('Бакалавр:')->addButtons($buttonArray);

                                    $this->ask($question, function (Answer $answer) {
                                        if ($answer->isInteractiveMessageReply()) {
                                            $bachelorId = Bachelor::where('id', '=', $answer->getValue())->first();
                                            if($answer->getValue() === 'back') {                         
                                                $this->askInfo();                                    
                                            } else {
                                                $this->say($bachelorId->content);
                                                $this->askInfo();
                                            }
                                        }
                                    }); 
                                break;
                                case 'accelerate':
                                        $bachelorAcc = BachelorAccelerated::where('is_public', '=', 1)->get();
                                    $buttonArray = [];
                                
                                    foreach ($bachelorAcc as $value) {
                                        $button = Button::create($value->title)->value($value->id);
                                        $buttonArray[] = $button;
                                    }

                                    $back = Button::create('Назад')->value('back');
                                    $buttonArray[] = $back;

                                    $question = Question::create('Бакалавр ускоренный:')->addButtons($buttonArray);

                                    $this->ask($question, function (Answer $answer) {
                                        if ($answer->isInteractiveMessageReply()) {
                                            $bachelorAccId = BachelorAccelerated::where('id', '=', $answer->getValue())->first();
                                            if($answer->getValue() === 'back') {                         
                                                $this->askInfo();                                    
                                            } else {
                                                $this->say($bachelorAccId->content);
                                                $this->askInfo();                                    
                                            }
                                        }
                                    }); 
                                break;
                                case 'master':
                                    $masterInfo = Master::where('is_public', '=', 1)->get();
                                    $buttonArray = [];
                                
                                    foreach ($masterInfo as $value) {
                                        $button = Button::create($value->title)->value($value->id);
                                        $buttonArray[] = $button;
                                    }

                                    $back = Button::create('Назад')->value('back');
                                    $buttonArray[] = $back;

                                    $question = Question::create('Магистр:')->addButtons($buttonArray);

                                    $this->ask($question, function (Answer $answer) {
                                        if ($answer->isInteractiveMessageReply()) {
                                            $masterId = Master::where('id', '=', $answer->getValue())->first();
                                            if($answer->getValue() === 'back') {                         
                                                $this->askInfo();                                    
                                            } else {
                                                $this->say($masterId->content);
                                                $this->askInfo();                                    
                                            }
                                        }
                                    }); 
                                break;
                                case 'graduate':
                                    $postgraduateInfo = Postgraduate::where('is_public', '=', 1)->get();
                                    $buttonArray = [];
                                
                                    foreach ($postgraduateInfo as $value) {
                                        $button = Button::create($value->title)->value($value->id);
                                        $buttonArray[] = $button;
                                    }

                                    $back = Button::create('Назад')->value('back');
                                    $buttonArray[] = $back;

                                    $question = Question::create('Аспирантура:')->addButtons($buttonArray);

                                    $this->ask($question, function (Answer $answer) {
                                        if ($answer->isInteractiveMessageReply()) {
                                            $postgraduateId = Postgraduate::where('id', '=', $answer->getValue())->first();
                                            if($answer->getValue() === 'back') {                         
                                                $this->askInfo();                                    
                                            } else {
                                                $this->say($postgraduateId->content);
                                                $this->askInfo();                                    
                                            }
                                        }
                                    }); 
                                break;
                                case 'back':                                
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
                        $this->say('До встречи. Для того, чтобы начать чат с ботом, введите и отправьте команду "/start"');
                    break;
                }
            }
        });    
    }

    public function bye()
    {
        $this->say('Спасибо! Ожидайте ответа. Для того, чтобы начать чат с ботом, введите и отправьте команду "/start"');
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

