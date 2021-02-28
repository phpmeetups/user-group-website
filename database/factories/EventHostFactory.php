<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventHost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventHostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventHost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory(),
            'user_id' => User::factory(),
        ];
    }
}
