<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\RSVP;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RSVPFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RSVP::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::class,
            'user_id' => User::class,
            'status' => $this->faker->randomElement([
               RSVP::STATUS_YES,
               RSVP::STATUS_NO,
            ]),
        ];
    }
}
