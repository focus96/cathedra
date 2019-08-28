<?php


use App\Admin\Controllers\NewsController;
use App\Admin\Controllers\CathedraInfoController;
use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/news', 'NewsController');
    $router->resource('/news-category', 'NewsCategoryController');
    $router->resource('/news-tags', 'NewsTagController');
    $router->resource('/albums', 'AlbumController');
    $router->resource('/events', 'EventController');
    $router->resource('/cathedra-users', 'CathedraUsersController');
    $router->resource('/groups', 'GroupsController');

    $router->resource('/items', 'ItemsController');
    $router->resource('/students', 'StudentsController');

    $router->resource('/telegram-bot/campaign/bachelor', 'BachelorController');
    $router->resource('/telegram-bot/campaign/bachelor-accelerated', 'BachelorAcceleratedController');
    $router->resource('/telegram-bot/campaign/master', 'MasterController');
    $router->resource('/telegram-bot/campaign/postgraduate', 'PostgraduateController');
    $router->resource('/telegram-bot/mailing/list', 'MailController');
    $router->resource('/telegram-bot/applicants/cathedra-info', 'CathedraInfoControllers');
    $router->resource('/telegram-bot/applicants/feedback', 'UserQuestionController');

    $router->get('/telegram-bot/mailing/mail', 'TelegramBotController@index');

    $router->resource('/cathedras', 'CathedraController');
    $router->resource('/teachers', 'TeacherController');
    $router->resource('/schedules', 'ScheduleController');
    $router->resource('/items', 'ItemController');
    $router->resource('/students', 'StudentController');

    $router->resource('/online_journals', 'OnlineJournalController');
    $router->get('/journals/{id}', 'JournalController@index')->name('journal');
    $router->post('/checkpoints', 'CheckPointController@store')->name('checkpoints');
    $router->get('/checkpoints/{id}/edit', 'CheckPointController@edit');
    $router->patch('/checkpoints/update/{id}', 'CheckPointController@update')->name('checkpoints_update');
    $router->delete('/checkpoints/delete/{id}', 'CheckPointController@destroy')->name('checkpoint_delete');
    $router->post('/student_points', 'StudentPointController@save');

    $router->get('/telegram-bot', 'TelegramBotController@index');
    $router->get('/telegram-bot/applicants/cathedra', 'TelegramBotController@cathedra');
    $router->resource('/cathedra-info', 'CathedraInfoControllers');
});