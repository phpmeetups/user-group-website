<?php

namespace Tests\Unit\Model;

use App\Models\Event;
use App\Models\EventHost;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * EventTest.
 *
 * @group event
 * @group model
 */
class EventHostTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testEventRelationship()
    {
        $event = Event::factory()->create();
        $user = User::factory()->create();
        $event_host = EventHost::factory()->create([
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);

        $this->assertEquals($event->id, $event_host->event->id);
        $this->assertInstanceOf(Event::class, $event_host->event);
    }

    public function testUserRelationship()
    {
        $event = Event::factory()->create();
        $user = User::factory()->create();
        $event_host = EventHost::factory()->create([
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);

        $this->assertEquals($user->id, $event_host->user->id);
        $this->assertInstanceOf(User::class, $event_host->user);
    }
}
