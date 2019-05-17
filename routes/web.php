<?php

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
Route::get('/news/{slug}','HomePageController@show')->name('news-show');

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
});

Route::prefix('online_journals')->group(function () {
    Route::get('/show_journal/{online_journal}', 'OnlineJournalController@show_journal');
    Route::get('/show_group/{group}', 'OnlineJournalController@show_group');

Route::prefix('students')->group(function () {
    Route::get('/', 'StudentsController@index');
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

Route::prefix('item')->group(function () {
    Route::get('/', 'ScheduleController@item');
});


Route::prefix('faculties')->group(function () {
    Route::get('/', 'ScheduleController@faculties');
});

Route::post('/subscribe','SubsController@subscribe');

Route::prefix('magazine')->group(function () {
    Route::get('/', 'MagazineController@index');
});

Route::view('/contact', 'contact');

Route::get('/get-all-cathedra-users', 'CathedraUserController@all');
Route::post('/send-telegram-message', 'TelegramBotController@send');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

