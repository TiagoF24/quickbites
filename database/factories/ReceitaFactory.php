<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receita>
 */
class ReceitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'descricao' => $this->faker->text(),
            'imagem' => $this->faker->imageUrl(),
            'video' => $this->faker->url(),
            'categoria' => $this->faker->word(),
            'tempo' => $this->faker->randomNumber(),
            'ingredientes' => $this->faker->text(),
        ];
    }
}
