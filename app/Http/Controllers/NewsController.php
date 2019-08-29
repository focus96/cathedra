<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::search()->beforePublicationDate()->orderBy('publication_date', 'DESC')->paginate(5);
        $popularNews = News::orderBy('views', 'DESC')->beforePublicationDate()->limit('5')->get();
        $categories = NewsCategory::withCount(['news'])->get();
        $tags = NewsTag::all();
        return View('news.index', compact(['news', 'popularNews', 'categories', 'tags']));
    }

    public function show(News $news)
    {
        $news->increment('views', 1);
        $popularNews = News::orderBy('views', 'DESC')->beforePublicationDate()->limit('5')->get();
        $previous = News::search()->beforePublicationDate()->where('id', '<', $news->id)->orderBy('id', 'DESC')->first();
        $next = News::search()->beforePublicationDate()->where('id', '>', $news->id)->orderBy('id', 'ASC')->first();
        $categories = NewsCategory::withCount(['news'])->get();
        $tags = NewsTag::all();
        return View('news.show', compact(['news', 'popularNews', 'previous', 'next', 'categories', 'tags']));
    }
}
