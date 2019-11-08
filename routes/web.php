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

Route::get('/', 'HomeController@index')->name('home');

Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::get('/curators', 'CuratorController@index')->name('curators-index');
Route::get('/study-plans', 'StudyPlanController@index')->name('study-plans-index');

Route::view('/about-us/general-info', 'about-us.general-info');
Route::get('/about-us/department-composition', 'DepartmentCompositionController@index');
Route::get('/about-us/department-composition/{teacher}', 'DepartmentCompositionController@show');
Route::view('/about-us/education', 'about-us.education');
Route::view('/about-us/firms', 'about-us.firms');
Route::view('/about-us/history', 'about-us.history');
Route::view('/about-us/international-relations', 'about-us.international-relations');
Route::view('/about-us/life', 'about-us.life');
Route::view('/about-us/nvk', 'about-us.nvk');
Route::view('/about-us/material-base', 'about-us.material-base');
Route::view('/about-us/science-work', 'about-us.science-work');
Route::view('/about-us/practic', 'about-us.practic');
Route::view('/about-us/branches', 'about-us.branches');
Route::view('/about-us/branch-app', 'about-us.branch-app');
Route::view('/about-us/branch-medical', 'about-us.branch-medical');
Route::view('/about-us/branch-network', 'about-us.branch-network');

Route::prefix('news')->group(function () {
    Route::get('/', 'NewsController@index')->name('news-index');
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

Route::prefix('applicants')->group(function () {
    Route::get('/', 'ApplicantsController@index')->name('applicants-index');
});

Route::prefix('online_journals')->group(function () {
    Route::get('/', 'OnlineJournalController@index');
    Route::get('/show_journal/{online_journal}', 'OnlineJournalController@show_journal');
    Route::get('/show_group/{group}', 'OnlineJournalController@show_group');
});
Route::get('/save-pdf/{id}', 'OnlineJournalController@savePdf');
Route::get('/save-xls/{id}', 'OnlineJournalController@saveXls');

Route::prefix('schedule')->group(function () {
    Route::get('/by-lecture-hall', 'ScheduleController@byLectureHall');
    Route::get('/by-group', 'ScheduleController@byGroup');
    Route::get('/by-teacher', 'ScheduleController@byTeacher');
});

Route::get('/download',function (){
    return Excel::download(new ScheduleExport, 'schedule.xlsx');
});

Route::post('/subscribe', 'EmailSubscriberController@subscribe');
Route::get('/confirm-email-subscribe/{subscribeEmail}', 'EmailSubscriberController@confirm');
Route::post('/resend-confirm-subscribe-email', 'EmailSubscriberController@resend');

Route::post('/feedback', 'FeedbackController@store')->name('feedback');

Route::post('/botman-students', 'StudentsTelegramBotController@hears');







Route::get('/get-all-cathedra-users', 'CathedraUserController@all');
Route::get('/get-all-cathedra-users-with-email-subscribers', 'CathedraUserController@allWithEmailSubscribers');

Route::post('/send-telegram-message', 'TelegramBotController@send');
Route::post('/send-mailing', 'MailingController@send');
Route::post('/botman', 'TelegramBotController@hears');







//Route::post('/subscribe','SubsController@subscribe');


Route::get('/register-telegram-url', function() {
  $ch = curl_init("https://api.telegram.org/bot705199406:AAH9XWBdk0OofJj4yinG4d1Ia4G2X8_89ok/setWebhook");

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
  	curl_setopt($ch, CURLOPT_POSTFIELDS,
            "url=https://dab266c5.ngrok.io/botman");

    curl_exec($ch);
    curl_close($ch);
});



//Route::post('/botman', 'TelegramBotHearsController@hears');
