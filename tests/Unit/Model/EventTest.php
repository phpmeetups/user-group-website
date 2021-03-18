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

    public function testAttendeeCount()
    {
        $event = Event::factory()->create();
        $users = User::factory()->count(6)->create();

        foreach ($users as $user) {
            $event->rsvps()->create([
                'user_id' => $user->id,
                'status' => RSVP::STATUS_YES,
            ]);
        }

        $this->assertEquals(6, $event->attendeeCount());
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

    public function testEventGetPhotoAttribute()
    {
        $event = Event::factory()->create(['featured_photo_url' => 'https://cataas.com/cat']);

        $this->assertStringContainsString('https://cataas.com/cat', $event->photo);
    }

    public function testEventGetPhotoAttributeHasFallback()
    {
        $event = Event::factory()->create();

        $this->assertNotEmpty($event->photo);
    }

    public function testEventIsOnline()
    {
        $event = Event::factory()->create(['type' => Event::TYPE_ONLINE]);

        $this->assertTrue($event->isOnline());
        $this->assertFalse($event->isPhysical());
        $this->assertFalse($event->isHybrid());
    }

    public function testEventIsHybrid()
    {
        $event = Event::factory()->create(['type' => Event::TYPE_HYBRID]);

        $this->assertTrue($event->isHybrid());
        $this->assertFalse($event->isOnline());
        $this->assertFalse($event->isPhysical());
    }

    public function testEventIsPhysical()
    {
        $event = Event::factory()->create(['type' => Event::TYPE_PHYSICAL]);

        $this->assertTrue($event->isPhysical());
        $this->assertFalse($event->isOnline());
        $this->assertFalse($event->isHybrid());
    }

    public function testCanRSVPToEvent()
    {
        $openForRSVP = Event::factory()->create([
            'rsvp_starts_at' => now()->startOfDay(),
            'rsvp_ends_at' => now()->endOfDay(),
        ]);

        $closedForRSVP = Event::factory()->create([
            'rsvp_starts_at' => now()->subDay()->startOfDay(),
            'rsvp_ends_at' => now()->subDay()->endOfDay(),
        ]);

        $this->assertTrue($openForRSVP->canRSVP());
        $this->assertFalse($closedForRSVP->canRSVP());
    }

    public function testEventIsUpcoming()
    {
        $upcomingEvent = Event::factory()->create(['starts_at' => now()->addDay()]);
        $previousEvent = Event::factory()->create(['starts_at' => now()->subDay()]);

        $this->assertTrue($upcomingEvent->isUpcoming());
        $this->assertFalse($previousEvent->isUpcoming());
    }

    public function testEventIsHappeningNow()
    {
        $happeningEvent = Event::factory()->create(['starts_at' => now()->subHour(), 'ends_at' => now()->endOfDay()]);
        $previousEvent = Event::factory()->create(['starts_at' => now()->subDay(), 'ends_at' => now()->subDay()]);

        $this->assertTrue($happeningEvent->isHappeningNow());
        $this->assertFalse($previousEvent->isHappeningNow());
    }

    public function testEventHasEnded()
    {
        $previousEvent = Event::factory()->create(['ends_at' => now()->subDay()]);
        $upcomingEvent = Event::factory()->create(['ends_at' => now()->addDay()]);

        $this->assertTrue($previousEvent->hasEnded());
        $this->assertFalse($upcomingEvent->hasEnded());
    }

    public function testEventIsCanceled()
    {
        $canceledEvent = Event::factory()->create(['status' => Event::STATUS_CANCELED]);
        $activeEvent = Event::factory()->create(['status' => Event::STATUS_ACTIVE]);

        $this->assertTrue($canceledEvent->isCanceled());
        $this->assertFalse($activeEvent->isCanceled());
    }
}
