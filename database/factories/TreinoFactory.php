<?php

namespace Database\Factories;

use App\Models\Exercicio;
use App\Models\Instrutor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treino>
 */
class TreinoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->word(),
            'descricao' => fake()->sentence(),
            'instrutor_id' => Instrutor::factory(),
        ];
    }

    public function configure(): static
    {
        $exercicios = Exercicio::all();

        return $this->afterCreating(function ($treino) use ($exercicios) {
            $treino->exercicios()->attach(
                fake()->randomElements(
                    $exercicios->pluck('id')->toArray(),
                    fake()->numberBetween(1, 10),
                    allowDuplicates: true
                )
            );
        });
    }
}
