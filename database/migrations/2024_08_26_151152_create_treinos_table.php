<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('treinos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->foreignId('instrutor_id')->constrained('instrutores');
            $table->timestamps();
        });

        Schema::create('aluno_treino', function (Blueprint $table) {
            $table->foreignId('aluno_id')->constrained('alunos')->cascadeOnDelete();
            $table->foreignId('treino_id')->constrained('treinos')->cascadeOnDelete();
            $table->integer('exercicios_feitos');
            $table->integer('exercicios_totais');
            $table->timestamps();
        });

        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->string('imagem');
            $table->string('video');
            $table->string('equipamento');
        });

        Schema::create('exercicio_treino', function (Blueprint $table) {
            $table->foreignId('exercicio_id')->constrained('exercicios')->cascadeOnDelete();
            $table->foreignId('treino_id')->constrained('treinos')->cascadeOnDelete();
            $table->integer('series');
            $table->integer('repeticoes');
        });

        Schema::create('grupos_musculares', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
        });

        Schema::create('exercicio_grupo_muscular', function (Blueprint $table) {
            $table->foreignId('exercicio_id')->constrained('exercicios')->cascadeOnDelete();
            $table->foreignId('grupo_muscular_id')->constrained('grupos_musculares')->cascadeOnDelete();
            $table->intensidade();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treinos');
        Schema::dropIfExists('aluno_treino');
        Schema::dropIfExists('exercicios');
        Schema::dropIfExists('exercicio_treino');
        Schema::dropIfExists('grupos_musculares');
        Schema::dropIfExists('exercicio_grupo_muscular');
    }
};
