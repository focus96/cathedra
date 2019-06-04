<?php

use App\Exports\ScheduleExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomePageController@index');
Route::post('/', 'HomePageController@regist');
Route::get('/news','HomePageController@show')->name('news-show');

Route::view('/about', 'about');

Route::prefix('news')->group(function () {
    Route::get('/', 'NewsController@index');
    Route::get('/{news}', 'NewsController@show')->name('news-show');
});

Route::prefix('event')->group(function () {
    Route::get('/', 'EventController@index');
    Route::get('/fetch', 'EventController@fetch');
    Route::get('/{event}', 'EventController@show')->name('event-show');
});

Route::prefix('album')->group(function () {
    Route::get('/', 'AlbumController@index');
    Route::get('/{album}', 'AlbumController@show')->name('album-show');
});

Route::prefix('online_journals')->group(function () {
    Route::get('/', 'OnlineJournalController@index');
    Route::get('/show_journal/{online_journal}', 'OnlineJournalController@show_journal');
    Route::get('/show_group/{group}', 'OnlineJournalController@show_group');
});


Route::prefix('schedule')->group(function () {
    Route::get('/', 'ScheduleController@index');
});

Route::prefix('teacher')->group(function () {
    Route::get('/', 'ScheduleController@teacher');
});

Route::prefix('lecture')->group(function () {
    Route::get('/', 'ScheduleController@lecture');
});

Route::get('/download',function (){
    return Excel::download(new ScheduleExport, 'schedule.xlsx');
});

Route::prefix('item')->group(function () {
    Route::get('/', 'ScheduleController@item');
});

Route::prefix('faculties')->group(function () {
    Route::get('/', 'ScheduleController@faculties');
});

Route::post('/subscribe','SubsController@subscribe');

Route::view('/contact', 'contact');

Route::get('/get-all-cathedra-users', 'CathedraUserController@all');

Route::post('/send-telegram-message', 'TelegramBotController@send');


Route::get('/register-telegram-url', function() {
  $ch = curl_init("https://api.telegram.org/bot636548977:AAF3TFV6jmYbSUxgyyW3PQbgjhVJ9gb7JUk/setWebhook");

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
  	curl_setopt($ch, CURLOPT_POSTFIELDS,
            "url=https://d563a71e.ngrok.io/botman");

    curl_exec($ch);
    curl_close($ch);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/save-pdf/{id}', 'SavePDFController@save');

Route::get('/save-xls/{id}', 'SaveXLSController@save');

Route::post('/botman', 'TelegramBotHearsController@hears');
