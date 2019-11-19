<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class MailingController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Управление email-рассылками');
            $content->description(' ');
            $content->body(view('admin.mailing.index'));
        });
    }

}
