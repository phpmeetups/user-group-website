<?php

namespace Tests\Unit\Model;

use App\Models\Event;
use App\Models\RSVP;
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
class RSVPTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testEventRelationship()
    {
        $event = Event::factory()->create();
        $user = User::factory()->create();
        $rsvp = RSVP::factory()->create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => RSVP::STATUS_YES,
        ]);

        $this->assertEquals($event->id, $rsvp->event->id);
        $this->assertInstanceOf(Event::class, $rsvp->event);
    }

    public function testUserRelationship()
    {
        $event = Event::factory()->create();
        $user = User::factory()->create();
        $rsvp = RSVP::factory()->create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => RSVP::STATUS_YES,
        ]);

        $this->assertEquals($user->id, $rsvp->user->id);
        $this->assertInstanceOf(User::class, $rsvp->user);
    }
}
