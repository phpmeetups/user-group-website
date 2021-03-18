<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\CarbonImmutable;
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
        $base = CarbonImmutable::parse($this->faker->dateTimeBetween('-18 months', '+3 months'));

        return [
            'featured_photo_url' => null,
            'title' => $this->faker->sentence(7),
            'starts_at' => $base,
            'ends_at' => $base->addHours(2),
            'rsvp_starts_at' => $base->subDays(7),
            'rsvp_ends_at' => $base->subDays(1),
            'type' => $this->faker->randomElement([
                Event::TYPE_PHYSICAL,
                Event::TYPE_ONLINE,
                Event::TYPE_HYBRID,
            ]),
            'online_url' => $this->faker->url,
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
