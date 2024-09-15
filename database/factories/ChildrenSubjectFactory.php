<?php

namespace Database\Factories;

use App\Models\Children;
use App\Models\ClasseSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChildrenSubject>
 */
class ChildrenSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'children_id' => Children::factory(), 
            'classe_subject_id' => ClasseSubject::factory(), 
            'score1' => $this->faker->randomFloat(2, 0, 10), 
            'score2' => $this->faker->randomFloat(2, 0, 10), 
            'score3' => $this->faker->randomFloat(2, 0, 10), 
            'score4' => $this->faker->randomFloat(2, 0, 10), 
        ];
    }
}
