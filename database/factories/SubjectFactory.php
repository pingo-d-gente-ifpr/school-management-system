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
        $names = [
            'Atividades Artísticas',
            'Brincadeiras de Movimento',
            'Histórias e Contos',
            'Exploração Sensorial',
            'Jogo Livre',
            'Desenvolvimento Motor',
            'Cantigas e Música',
            'Contação de Histórias',
            'Pintura e Desenho',
            'Jardinagem Infantil',
            'Exploração da Natureza',
            'Contação de Fábulas',
            'Brincadeiras com Água',
            'Desenvolvimento da Linguagem',
            'Jogos de Encaixar',
            'Histórias da Vida Real',
            'Jogos de Role Play',
            'Exploração Tátil',
            'Atividades de Coordenação',
            'Jogos Educativos',
            'Atividades de Cores e Formas',
            'Brincadeiras com Areia',
            'Desenvolvimento da Socialização',
            'Histórias de Animais',
            'Atividades com Massinha',
        ];

        $photos = [
            'images/subjects/1.png',
            'images/subjects/2.png',
            'images/subjects/3.png',
            'images/subjects/4.png',
            'images/subjects/5.png',
        ];

        return [
            'name' => $this->faker->randomElement($names),
            'photo' => $this->faker->randomElement($photos),
        ];
    }
}
