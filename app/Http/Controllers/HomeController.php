<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Event;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularNews = News::orderBy('views', 'DESC')->beforePublicationDate()->limit('8')->get();
        $events = Event::orderBy('start_date', 'DESC')->limit('8')->get();
        $albums = Album::all()->random(4);
        return view('index', compact(['popularNews', 'events', 'albums']));
    }
}
