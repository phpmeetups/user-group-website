<?php

namespace Tests\Unit\Model;

use App\Models\Event;
use App\Models\EventHost;
use App\Models\RSVP;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * EventTest.
 *
 * @group user
 * @group event
 * @group model
 */
class UserTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testRsvpsRelationship()
    {
        $user = User::factory()->create();
        RSVP::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals(3, $user->rsvps()->count());
        $this->assertInstanceOf(RSVP::class, $user->rsvps()->first());
    }

    public function testHostingRelationship()
    {
        $user = User::factory()->create();
        EventHost::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals(3, $user->hosting()->count());
        $this->assertInstanceOf(Event::class, $user->hosting()->first());
    }
}
