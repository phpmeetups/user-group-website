<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::latest()->paginate(20);

        return view('events.index', [
            'user' => $request->user(),
            'events' => $events,
        ]);
    }

    public function show(Request $request, Event $event)
    {
        return view('events.show', [
            'event' => $event,
            'user' => $request->user(),
        ]);
    }
}
