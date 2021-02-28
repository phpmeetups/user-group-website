<?php

namespace Database\Factories;

use App\DTOs\AddressDTO;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class VenueFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $address = new AddressDTO([
            'street' => '411 Woody Hayes Dr, Columbus, OH 43210',
            'city' => 'Columbus',
            'region' => 'Ohio',
            'country' => 'United States',
            'postal_code' => '43210',
            'latitude' => 40.00165427547327,
            'longitude' => -83.01974247042817,
        ]);

        return [
            'name' => $this->faker->company,
            'address' => $address->toString(),
            'website' => $this->faker->optional()->url,
            'about' => $this->faker->optional()->text,
            'driving_directions' => $this->faker->optional()->text,
        ];
    }
}
