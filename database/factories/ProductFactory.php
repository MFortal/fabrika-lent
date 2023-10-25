<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StatusTypes;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'article' => fake()->unique()->text(10),
            'status' => rand(0, 1) ? StatusTypes::Available() : StatusTypes::Unavailable(),
            'data' => '{"color": "red","size": 5}',
        ];
    }
}
