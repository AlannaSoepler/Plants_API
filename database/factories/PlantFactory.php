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
     * The factory is used instead of manually assigning the values in each column. 
     * Using the fake function, the factory has access to the faker library. 
     * This library generates various kinds of data which will be used for testing and seeding.  
     * 
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'breed' => fake()->name(),
            //Creates a random url image with px size 640x480
            'image' => fake()->imageUrl(640,480),
            //creates a paragraph consisting on 3 sentences 
            'info' => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            //randomly choose between the listed elements 
            'season' => fake()->randomElement([
                'spring',
                'summer',
                'autumn',
                'winter'
            ]),
            'hight' => fake()->randomFloat(2, 0, 100),
            // 'provider_id' => fake()->name(),
            //random number between 0 - 10000
            'likes' => fake()->numberBetween(0,10000)
        ];
    }
}
