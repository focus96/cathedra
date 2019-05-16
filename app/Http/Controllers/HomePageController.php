<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\User;
use App\Models\Event;


class HomePageController extends Controller
{
    public function regist(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/about')->with('status', 'Спасибо за регистрацию!');
    }
    public function index()
    {
        $news = News::all();
        $events = Event::all();
        $popularNews = News::orderBy('views', 'DESC')->limit('5')->get();
        return view('index',['news' =>$news,'events'=>$events, 'popularNews'=>$popularNews]);
    }

    public function show($slug)
    {
        $news = News::where('slug',$slug)->firstOrFail();
        $popularNews = News::orderBy('views', 'DESC')->limit('5')->get();
        $previous = News::where('id', '<', $news->id)->orderBy('id', 'DESC')->first();
        $next = News::where('id', '>', $news->id)->orderBy('id', 'ASC')->first();
        return view('news\show', compact('news', 'popularNews', 'previous', 'next'));
    }
}
