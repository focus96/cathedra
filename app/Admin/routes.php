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

    /*
     * Dashboard
     */
    $router->get('/', 'HomeController@index');
    $router->post('/save-party', 'HomeController@saveParty');

    /*
     * Entities
     */
    $router->resource('/news', 'NewsController');
    $router->resource('/news-category', 'NewsCategoryController');
    $router->resource('/news-tags', 'NewsTagController');
    $router->resource('/albums', 'AlbumController');
    $router->resource('/events', 'EventController');
    $router->resource('/cathedra-users', 'CathedraUsersController'); // @deprecated
    $router->resource('/groups', 'GroupsController');
    $router->resource('/specializations', 'SpecializationController');
    $router->resource('/study-plans', 'StudyPlanController');
    $router->resource('/feedback', 'FeedbackController');
    $router->resource('/pages', 'PageController');
    $router->resource('/students', 'StudentsController');
    $router->resource('/cathedras', 'CathedraController');
    $router->resource('/teachers', 'TeacherController');
    $router->resource('/schedules', 'ScheduleController');
    $router->resource('/students', 'StudentController');
    $router->resource('/items', 'ItemController');
    $router->resource('/email-subscriber', 'EmailSubscriberController');

    /*
     * Telegram
     */
    $router->resource('/telegram-bot/campaign/bachelor', 'BachelorController');
    $router->resource('/telegram-bot/campaign/bachelor-accelerated', 'BachelorAcceleratedController');
    $router->resource('/telegram-bot/campaign/master', 'MasterController');
    $router->resource('/telegram-bot/campaign/postgraduate', 'PostgraduateController');

    $router->resource('/cathedra-info', 'CathedraInfoControllers');
    $router->resource('/telegram-bot/applicants/cathedra-info', 'CathedraInfoControllers');
    $router->resource('/telegram-bot/applicants/feedback', 'UserQuestionController');

    $router->resource('/telegram-bot/applicants/data', 'TelegramBotApplicantsController');
    $router->resource('/telegram-bot/applicants/feedback', 'TelegramApplicantsFeedbackController');
    $router->get('/telegram-bot/applicants/feedback/send/{feedback}', 'TelegramApplicantsFeedbackController@send');


    /*
     * Telegram mailing
     */
    $router->get('/telegram-bot/mailing', 'TelegramBotController@index');
    $router->resource('/telegram-bot/mailing-history', 'TelegramMailingHistoryController');


    /*
     * Email-mailing
     */
    $router->get('/mailing', 'MailingController@index');
    $router->resource('/mailing-history', 'MailingHistoryController');

    /*
     * Online-journal
     */
    $router->resource('/online_journals', 'OnlineJournalController');
    $router->get('/journals/{id}', 'JournalController@index')->name('journal');
    $router->post('/checkpoints', 'CheckPointController@store')->name('checkpoints');
    $router->get('/checkpoints/{id}/edit', 'CheckPointController@edit');
    $router->patch('/checkpoints/update/{id}', 'CheckPointController@update')->name('checkpoints_update');
    $router->delete('/checkpoints/delete/{id}', 'CheckPointController@destroy')->name('checkpoint_delete');
    $router->post('/student_points', 'StudentPointController@save');




});
