<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Str;

class EventObserver
{
    public function creating(Event $event)
    {
        if (!$event->uuid) {
            $event->uuid = Str::uuid();
        }
    }
}
