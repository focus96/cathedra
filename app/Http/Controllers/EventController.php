<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index():View
    {
        $events = Event::paginate(config('countEventByPage', 10));
        return View('event.index', compact(['events']));
    }

    public function fetch():JsonResponse
    {
        $events = Event::paginate(config('countEventByPage', 10));
        return response()->json($events);
    }

    public function show(Event $event)
    {
        $previous = Event::where('id', '<', $event->id)->orderBy('id', 'DESC')->first(['id']);
        $next = Event::where('id', '>', $event->id)->orderBy('id', 'ASC')->first(['id']);
        return View('event.show', compact(['event', 'previous', 'next']));
    }
}
