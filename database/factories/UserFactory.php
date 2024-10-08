<?php

namespace Database\Factories;

use App\Enums\Role;
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
        $names = [
            'João Silva',
            'Maria Oliveira',
            'Pedro Santos',
            'Ana Costa',
            'Carlos Almeida',
            'Patrícia Lima',
            'Lucas Ferreira',
            'Fernanda Rocha',
            'Gabriel Souza',
            'Juliana Pereira',
            'André Martins',
            'Aline Santos',
            'Ricardo Alves',
            'Camila Campos',
            'Rafael Lima',
            'Larissa Gomes',
            'Thiago Rodrigues',
            'Juliana Carvalho',
            'Marcos Nascimento',
            'Beatriz Castro',
            'Renato Ferreira',
            'Priscila Moreira',
            'Lucas Pacheco',
            'Isabela Almeida',
            'Vinícius Pereira',
            'Júlia Souza',
            'Leonardo Oliveira',
            'Giovana Mendes',
            'Felipe Rocha',
            'Vanessa Martins',
        ];

        return [
            'name' => $this->faker->randomElement($names),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'birth_date' => $this->faker->date,
            'document_cpf' => $this->faker->unique()->numerify('###########'),
            'gender' => $this->faker->randomElement(['masculino', 'feminino', 'outro']),
            'cellphone' => $this->faker->phoneNumber,
            'emergency_name' => $this->faker->name,
            'emergency_cellphone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement([true, false]),
            'role' => $this->faker->randomElement(Role::cases()),
            'zip_code' => $this->faker->numerify('#####-###'),
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'neighborhood' => $this->faker->streetSuffix,
            'complement' => $this->faker->secondaryAddress,
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
