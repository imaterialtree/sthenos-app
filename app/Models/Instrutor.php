<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instrutor extends Model
{
    use HasFactory;

    protected $table = 'instrutores';

    public $timestamps = false;

    /* 
    * Relacionamentos
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function qualificacoes(): BelongsToMany
    {
        return $this->belongsToMany(Qualificacao::class, 'instrutor_qualificacao', 'instrutor_id', 'qualificacao_id');
    }

    public function treinos(): HasMany
    {
        return $this->hasMany(Treino::class, 'instrutor_id');
    }
}
