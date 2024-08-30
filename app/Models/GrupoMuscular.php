<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GrupoMuscular extends Model
{
    use HasFactory;

    protected $table = 'grupos_musculares';

    protected $fillabel = [
        'nome',
    ];


    /* 
    * Relacionamentos
    */
    public function exercicios(): BelongsToMany
    {
        return $this->belongsToMany(
            Exercicio::class,
            'exercicio_grupo_muscular', // tabela pivo (plural irregular)
            'grupos_musculares_id', // FK no pivo para model atual
        )->withPivot('intensidade');
    }
}
