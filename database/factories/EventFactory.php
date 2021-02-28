<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'featured_photo_url' => null,
            'title' => $this->faker->title,
            'starts_at' => $this->faker->dateTime('+5 hours'),
            'ends_at' => $this->faker->dateTime('+7 hours'),
            'rsvp_starts_at' => $this->faker->dateTime('+3 hours'),
            'rsvp_ends_at' => $this->faker->dateTime('+4 hours'),
            'type' => $this->faker->randomElement([
                Event::TYPE_PHYSICAL,
                Event::TYPE_ONLINE,
                Event::TYPE_HYBRID,
            ]),
            'online_instructions' => $this->faker->optional()->text,
            'description' => $this->faker->text,
            'attendee_limit' => $this->faker->optional()->numberBetween(1, 1000),
            'allowed_guests' => $this->faker->optional()->numberBetween(1, 10),
            'status' => $this->faker->randomElement([
                Event::STATUS_ACTIVE,
                Event::STATUS_CANCELED,
            ]),
        ];
    }
}
