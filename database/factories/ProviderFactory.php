<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
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
            'logo' => fake()->imageUrl(640,480),
            'info' => fake()->paragraph($nbSentences = 5, $variableNbSentences = true),
            'email' => fake()->unique()->email(),
            'telephone' => fake()->unique()->phoneNumber()
        ];
    }
}
