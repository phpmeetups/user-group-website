<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return Event::paginate(20);
    }

    public function show(Event $event)
    {
        return $event;
    }
}
