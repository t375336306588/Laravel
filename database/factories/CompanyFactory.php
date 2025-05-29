<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Building;
use App\Models\Activity;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'building' => $this->faker->streetAddress,
            'activity' => $this->faker->catchPhrase,
            'building_id' => Building::inRandomOrder()->first()->id,
            'activity_id' => Activity::inRandomOrder()->first()->id,
        ];
    }
}
