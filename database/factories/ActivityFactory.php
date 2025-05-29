<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
        ];
    }
    
    public function withParent($parentId = null)
    {
        return $this->state([
            'parent_id' => $parentId,
        ]);
    }
}
