<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Exercicio extends Model
{
    use HasFactory;

    protected $table = 'exercicios';

    public $timestamps = false;

    protected $fillable = [
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

    /**
     * Armazena uma imagem ou um video no storage e na model
     * 
     * @param UploadedFile $arquivo
     * @param string $tipo {'imagem', 'video'}
     */
    public function storeArquivo(UploadedFile $arquivo, string $tipo)
    {
        if (! in_array($tipo,  ['imagem', 'video']) || ! $arquivo) {
            return;
        }

        $path = $arquivo->store("exercicio/$tipo", 'public');
        $this->$tipo = Storage::url($path);
        $this->save();
    }
}
