<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    public $timestamps = false;

    protected $fillabel = [
        'data_nascimento',
        'peso',
        'altura',
    ];

    /* 
    * Relacionamentos
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function treinos(): BelongsToMany
    {
        return $this->belongsToMany(Treino::class)
            ->using(AlunoTreino::class)
            ->withPivot('exercicios_feitos', 'exercicios_totais', 'finalizado_em')
            ->withTimestamps('criado_em', 'atualizado_em');
    }
}
