<?php

namespace Tests\Unit\Model;

use App\Models\Event;
use App\Models\RSVP;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * EventTest.
 *
 * @group event
 * @group model
 */
class EventTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testHostsRelationship()
    {
        $event = Event::factory()->create();
        $hosts = User::factory()->create();
        $event->hosts()->sync($hosts);

        $this->assertEquals(1, $event->hosts()->count());
        $this->assertInstanceOf(User::class, $event->hosts()->first());

        $additional_hosts = User::factory()->count(2)->create();
        $event->hosts()->attach($additional_hosts);

        $this->assertEquals(3, $event->hosts()->count());
    }

    public function testRSVPsRelationship()
    {
        $event = Event::factory()->create();
        $users = User::factory()->count(5)->create();

        foreach ($users as $user) {
            $event->rsvps()->create([
                'user_id' => $user->id,
                'status' => RSVP::STATUS_YES,
            ]);
        }

        $this->assertEquals(5, $event->rsvps()->count());
        $this->assertInstanceOf(RSVP::class, $event->rsvps()->first());
    }

    public function testVenuesRelationship()
    {
        $event = Event::factory()->create();
        $venues = Venue::factory()->create();
        $event->venues()->sync($venues);

        $this->assertEquals(1, $event->venues()->count());
        $this->assertInstanceOf(Venue::class, $event->venues()->first());

        $additional_venues = Venue::factory()->count(2)->create();
        $event->venues()->attach($additional_venues);

        $this->assertEquals(3, $event->venues()->count());
    }

    public function testAUuidIsSetWhenCreatingAnEvent()
    {
        $event = Event::factory()->create();
        $this->assertNotNull($event->uuid);
    }
}
