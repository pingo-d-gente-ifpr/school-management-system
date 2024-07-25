<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
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
            'start_date' => $this->faker->time,
            'end_date' => $this->faker->time,
            'photo' => $this->faker->randomElement($photos),
            'user_id' => User::factory(),
        ];
    }
}
