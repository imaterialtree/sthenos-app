<?php

namespace Database\Factories;

use App\Models\Instrutor;
use App\Models\Qualificacao;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instrutor>
 */
class InstrutorFactory extends Factory
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
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Instrutor $instrutor) {
            // configurar usuario
            if (isset($instrutor->user)) {
                $instrutor->user->tipo = 1;
            }
        })
        ->afterCreating(function (Instrutor $instrutor) {
            // configurar usuario
            $instrutor->user?->update(['tipo' => 1]);

            // anexar qualificacoes
            $instrutor->qualificacoes()->attach(
                fake()->randomElements(
                    Qualificacao::all()->pluck('id')->toArray(),
                    fake()->numberBetween(1, 3)
                )
            );
        });
    }
}
