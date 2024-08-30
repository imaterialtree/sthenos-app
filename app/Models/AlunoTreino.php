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
        'finalizado_em' => 'timestamp',
    ];

    public function progresso() 
    {
        if ($this->exercicios_totais > 0) {
            return ($this->exercicios_feitos / $this->exercicios_totais) * 100;
        }

        return 0;
    }
}
