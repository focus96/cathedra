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

Auth::routes();

Route::get('/', 'HomePageController@index');
Route::post('/', 'HomePageController@regist');

Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::get('/curators', 'CuratorController@index')->name('curators-index');

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
    Route::get('/', 'AlbumController@index')->name('album-index');
    Route::get('/{album}', 'AlbumController@show')->name('album-show');
});

Route::prefix('online_journals')->group(function () {
    Route::get('/', 'OnlineJournalController@index');
    Route::get('/show_journal/{online_journal}', 'OnlineJournalController@show_journal');
    Route::get('/show_group/{group}', 'OnlineJournalController@show_group');
});

Route::prefix('schedule')->group(function () {
    Route::get('/by-lecture-hall', 'ScheduleController@byLectureHall');
    Route::get('/by-group', 'ScheduleController@byGroup');
    Route::get('/by-teacher', 'ScheduleController@byTeacher');
});

Route::get('/download',function (){
    return Excel::download(new ScheduleExport, 'schedule.xlsx');
});









//Route::post('/subscribe','SubsController@subscribe');

Route::get('/get-all-cathedra-users', 'CathedraUserController@all');

Route::post('/send-telegram-message', 'TelegramBotController@send');
Route::get('/register-telegram-url', function() {
  $ch = curl_init("https://api.telegram.org/bot705199406:AAH9XWBdk0OofJj4yinG4d1Ia4G2X8_89ok/setWebhook");

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
  	curl_setopt($ch, CURLOPT_POSTFIELDS,
            "url=https://dab266c5.ngrok.io/botman");

    curl_exec($ch);
    curl_close($ch);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/save-pdf/{id}', 'SavePDFController@save');
Route::get('/save-xls/{id}', 'SaveXLSController@save');

//Route::post('/botman', 'TelegramBotHearsController@hears');
Route::post('/botman', 'TelegramBotController@hears');
