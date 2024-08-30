<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Qualificacao extends Model
{
    use HasFactory;

    protected $table = 'qualificacoes';

    public $timestamps = false;

    protected $fillabel = [
        'nome',
        'nivel',
    ];

    /* 
    * Relacionamentos
    */
    public function qualificacoes(): BelongsToMany
    {
        return $this->belongsToMany(
            Instrutor::class,
            'instrutor_qualificacao', // tabela pivo (plural irregular)
            'qualificacao_id', // FK do pivo 
        );
    }
}
