<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Children>
 */
class ChildrenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date,
            'document' => $this->faker->unique()->numerify('##########'),
            'gender' => $this->faker->randomElement(['masculino', 'feminino']),
            'status' => $this->faker->boolean,
            'register_number' => $this->faker->unique()->numerify('REG########'),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
