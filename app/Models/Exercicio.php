<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercicio extends Model
{
    use HasFactory;

    protected $table = 'exercicios';

    public $timestamps = false;

    protected $fillabel = [
        'nome',
        'descricao',
        'imagem',
        'video',
        'equipamento',
    ];

    /* 
    * Relacionamentos
    */
    public function gruposMusculares(): BelongsToMany
    {
        return $this->belongsToMany(
            GrupoMuscular::class, // relacionado
            table: 'exercicio_grupo_muscular', // tabela pivo (plural irregular)
            relatedPivotKey: 'grupos_musculares_id' // FK no pivo para o relacionado (plural irregular)
        )->withPivot('intensidade');
    }

    public function treinos(): BelongsToMany
    {
        return $this->belongsToMany(Treino::class)->withPivot('repeticoes');
    }
}
