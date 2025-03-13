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
            'receita_titulo' => $this->faker->sentence,
            'receita_descricao' => $this->faker->paragraph,
            'receita_foto' => $this->faker->imageUrl(),
            'categoria' => $this->faker->word,
            'receita_duracao' => $this->faker->word,
        ];
    }
}
