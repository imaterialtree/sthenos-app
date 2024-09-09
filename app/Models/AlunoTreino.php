<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AlunoTreino extends Pivot
{
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'exercicios_feitos',
        'exercicios_totais',
    ];

    protected $casts = [
        'criado_em' => 'datetime',
        'atualizado_em' => 'datetime',
        'finalizado_em' => 'datetime',
    ];

    public function progresso() 
    {
        if ($this->exercicios_totais > 0) {
            return ($this->exercicios_feitos / $this->exercicios_totais) * 100;
        }

        return 0;
    }

    public static function fake(): array
    {
        $feitos = fake()->numberBetween(0, 15);
        $totais = fake()->numberBetween(10, 20);

        if ($feitos > $totais) {
            $feitos = $totais;
        }

        if ($feitos == $totais) {
            $finalizado_em = fake()->dateTimeBetween(now()->subDays(30), now());
        } else {
            $finalizado_em = null;
        }

        return [
            'exercicios_feitos' => $feitos,
            'exercicios_totais' => $totais,
            'finalizado_em' => $finalizado_em,
        ];
    }
}
