<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Building>
 */
class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->buildingNumber,
            'address_line1' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'country' => 'Россия',
            'latitude' => $this->faker->latitude(55.5, 56.0),
            'longitude' => $this->faker->longitude(37.3, 37.8),
            'district' => $this->faker->optional(0.6)->citySuffix,
        ];
    }
}
