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

        $names =[
            'Jeni Melânciosa',
            'Juju Ensolarada',
            'Joe Baldeco',
            'Jiba Bolado',
            'Juca Gelado',
        ];

        return [
            'name' => $this->faker->randomElement($names),
            'photo' => $this->faker->randomElement($photos),
            'period' => $this->faker->randomElement(['morning', 'afternoon', 'fulltime']),
            'year' => $this->faker->year(),
            'stage' => $this->faker->randomElement(['maternal', 'garden I', 'garden II', 'garden III']),
        ];
    }
}
