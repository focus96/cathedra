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

Route::get('/', function () {
    return view('index');
});

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

Route::view('/contact', 'contact');

Route::get('/get-all-cathedra-users', 'CathedraUserController@all');
Route::post('/send-telegram-message', 'TelegramController@send');


Route::get('/register-telegram-url', function() {
  $ch = curl_init("https://api.telegram.org/bot636548977:AAF3TFV6jmYbSUxgyyW3PQbgjhVJ9gb7JUk/setWebhook");

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
  	curl_setopt($ch, CURLOPT_POSTFIELDS,
            "url=https://298bd188.ngrok.io/botman");

    curl_exec($ch);
    curl_close($ch);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

