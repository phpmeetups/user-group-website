<?php

namespace Tests\Unit\Model;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * VenueTest.
 *
 * @group event
 * @group model
 */
class VenueTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testEventsRelationship()
    {
        $events = Event::factory()->count(5)->create();
        $venue = Venue::factory()->create();
        $venue->events()->sync($events);

        $this->assertEquals(5, $venue->events()->count());
        $this->assertInstanceOf(Event::class, $venue->events()->first());
    }
}
