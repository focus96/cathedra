<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class HomePageController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('index',['news' => $news]);
    }
}
