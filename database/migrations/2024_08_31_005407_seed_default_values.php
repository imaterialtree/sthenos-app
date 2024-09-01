<?php

use App\Models\Exercicio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('qualificacoes')->insert([
            ['nome' => 'Personal Trainer', 'nivel' => 'Especializacao'],
            ['nome' => 'CrossFit', 'nivel' => 'Nível 1'],
            ['nome' => 'Fisioterapia', 'nivel' => 'Graduação'],
            ['nome' => 'Nutrição', 'nivel' => 'Graduação'],
            ['nome' => 'Educação Física', 'nivel' => 'Graduação'],
            ['nome' => 'Musculação', 'nivel' => 'Nível 3'],
            ['nome' => 'Instrutor de Yoga', 'nivel' => 'Nível 3'],
            ['nome' => 'Instrutor de Pilates', 'nivel' => 'Nível 3'],
        ]);

        DB::table('grupos_musculares')->insert([
            ['nome' => 'Abdômen'],
            ['nome' => 'Adutores'],
            ['nome' => 'Bíceps'],
            ['nome' => 'Glúteos'],
            ['nome' => 'Isquiotibiais'],
            ['nome' => 'Lombar'],
            ['nome' => 'Ombros'],
            ['nome' => 'Panturrilhas'],
            ['nome' => 'Parte inferior das costas'],
            ['nome' => 'Peito'],
            ['nome' => 'Pernas'],
            ['nome' => 'Quadríceps'],
            ['nome' => 'Tríceps'],
        ]);

        DB::table('exercicios')->insert([
            ['nome' => 'Abdominais', 'descricao' => 'Exercício para o abdômen.'],
            ['nome' => 'Agachamento', 'descricao' => 'Exercício para as pernas.'],
            ['nome' => 'Prancha', 'descricao' => 'Exercício para o core'],
            ['nome' => 'Polichinelo', 'descricao' => 'Pule para cima e para baixo'],
            ['nome' => 'Flexão', 'descricao' => 'Exercício para as pernas.'],
            ['nome' => 'Flexão hindu', 'descricao' => 'Exercício para as pernas.'],
            ['nome' => 'Alongamento cobra', 'descricao' => 'Exercício para as pernas.'],
            ['nome' => 'Alongamento do peito', 'descricao' => 'Exercício para o peito.'],
        ]);        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
