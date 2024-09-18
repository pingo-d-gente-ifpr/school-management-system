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
        $names = [
            'Lucas Pereira',
            'Sofia Costa',
            'Mateus Oliveira',
            'Isabela Silva',
            'Gabriel Almeida',
            'Mariana Santos',
            'Pedro Lima',
            'Laura Rocha',
            'Rafael Carvalho',
            'Ana Clara Fernandes',
            'Leonardo Souza',
            'Giovanna Martins',
            'Felipe Almeida',
            'Juliana Ribeiro',
            'João Pedro Almeida',
            'Camila Silva',
            'Daniela Castro',
            'Thiago Mendes',
            'Beatriz Lima',
            'Andréa Gomes',
            'Victor Hugo Oliveira',
            'Larissa Nunes',
            'Gustavo Costa',
            'Marina Pereira',
            'Ricardo Santos',
        ];

        return [
            'name' => $this->faker->randomElement($names),
            'birth_date' => $this->faker->date,
            'document' => $this->faker->unique()->numerify('##########'),
            'gender' => $this->faker->randomElement(['masculino', 'feminino']),
            'status' => $this->faker->boolean,
            'register_number' => $this->faker->unique()->numerify('REG########'),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
