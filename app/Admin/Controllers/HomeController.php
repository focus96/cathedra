<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index(Content $content)
    {
        $settings = get_settings();

        $data = compact(['settings']);

        return Admin::content(function (Content $content) use($data) {
            $content->header('Админ-панель сайта кафедры АПП');
            $content->description(' ');
            $content->body(view('admin.dashboard.index', $data));
        });
    }

    public function saveParty(Request $request)
    {
        $settings = get_settings();
        $settings->party_week = $request->party;
        $settings->party_week_number = date('W');
        set_settings($settings);

        return response()->json(['message' => 'success']);
    }

}
