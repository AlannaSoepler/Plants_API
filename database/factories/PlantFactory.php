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
            'name' => fake()->name(),
            'breed' => fake()->name(),
            'image' => fake()->imageUrl(640,480),
            'info' => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            'season' => fake()->randomElement([
                'spring',
                'summer',
                'autumn',
                'winter'
            ]),
            'hight(m)' => fake()->randomFloat(2, 0, 100),
            'provider' => fake()->name(),
            'likes' => fake()->numberBetween(0,10000)
        ];
    }
}
