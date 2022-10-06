<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'breed' => fake()->name(),
            'image' => fake()->imageUrl(640,480),
            'info' => fake()->realText(150),
            'season' => fake()->randomElement([
                'Spring',
                'Summer',
                'Autumn',
                'Winter'
            ]),
            'provider' => Str::random(10),
            'available' =>fake()->boolean(),
            'likes' => fake()->numberBetween(0,10000)
        ];
    }
}
