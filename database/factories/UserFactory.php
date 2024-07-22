<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'birth_date' => $this->faker->date,
            'document_cpf' => $this->faker->unique()->numerify('###########'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'cellphone' => $this->faker->phoneNumber,
            'emergency_name' => $this->faker->name,
            'emergency_cellphone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement([true, false]),
            'role' => $this->faker->randomElement(['Teacher', 'Parents']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
