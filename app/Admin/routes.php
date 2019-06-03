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
   
});
