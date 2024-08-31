<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'data_nascimento' => fake()->dateTimeBetween(now()->subYears(60), now()->subYears(14)),
            'peso' => fake()->randomFloat(2, 30, 150),
            'altura' => fake()->biasedNumberBetween(100, 220),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Aluno $aluno) {
            $aluno->user->tipo = 2;
        })
        ->afterCreating(function (Aluno $aluno) {
            $aluno->user->update(['tipo' => 2]);
        });
    }
}
