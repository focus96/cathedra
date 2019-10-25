<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegisterTelegramBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:register {type} {uri}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register telegram bot.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $uri = $this->argument('uri');
        $type = $this->argument('type');
        $telegramConfig = config('bot.telegram');

        if(!array_key_exists($type, $telegramConfig)) {
            echo "Type {$type} not found" . PHP_EOL;
        }

        $token = $telegramConfig[$type]['token'];

        $ch = curl_init("https://api.telegram.org/bot{$token}/setWebhook");

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "url={$uri}/botman-$type");

        $result = curl_exec($ch);
        curl_close($ch);

        echo $result . PHP_EOL;
    }
}
