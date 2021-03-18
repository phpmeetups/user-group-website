<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\RSVP;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Event::factory()
            ->has(Venue::factory(), 'venues')
            ->count(30)
            ->create();

        User::factory()
            ->count(20)
            ->create()
            ->each(function ($user) {
                RSVP::create([
                    'event_id' => Event::inRandomOrder()->first()->id,
                    'user_id' => $user->id,
                    'status' => RSVP::STATUS_YES,
                ]);
            });
    }
}
