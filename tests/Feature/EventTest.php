<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * EventTest.
 *
 * @group event
 */
class EventTest extends TestCase
{
    use RefreshDatabase;

    public function testAnEventCanBeViewed()
    {
        $event = Event::factory()->create([
            'title' => 'My fancy Event',
            'type' => Event::TYPE_PHYSICAL,
            'starts_at' => Carbon::parse('today at 8pm'),
            'ends_at' => Carbon::parse('today at 10pm'),
        ]);

        $response = $this->get('/events/' . $event->uuid);
        $response->assertOk()
            ->assertSee('My fancy Event');
    }

    public function testPaginatedEventsCanBeViewed()
    {
        Event::factory()->create(['title' => 'first event']);
        Event::factory()->count(19)->create(['title' => 'other events']);
        Event::factory()->create(['title' => 'future event']);

        $response = $this->get('/events');
        $response->assertOk()
            ->assertSee('first event')
            ->assertDontSee('future event');
    }
}
