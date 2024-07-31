<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classe>
 */
class ClasseFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $photos = [
            'images/subjects/1.png',
            'images/subjects/2.png',
            'images/subjects/3.png',
            'images/subjects/4.png',
            'images/subjects/5.png',
        ];

        return [
            'name' => $this->faker->word,
            'photo' => $this->faker->randomElement($photos),
            'period' => $this->faker->randomElement(['morning', 'afternoon', 'full_time']),
            'stage' => $this->faker->randomElement(['maternal', 'garden I', 'garden II', 'garden III']),
        ];
    }
}
