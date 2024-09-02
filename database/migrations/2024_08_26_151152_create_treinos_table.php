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
            $table->foreignId('instrutor_id')->constrained('instrutores'); //->nullOnDelete();
            $table->timestamp('criado_em')->default(now());
            $table->timestamp('atualizado_em')->default(now());
        });

        Schema::create('aluno_treino', function (Blueprint $table) {
            $table->foreignId('aluno_id')->constrained('alunos')->cascadeOnDelete();
            $table->foreignId('treino_id')->constrained('treinos')->cascadeOnDelete();
            $table->integer('exercicios_feitos');
            $table->integer('exercicios_totais');
            $table->timestamp('criado_em')->default(now());
            $table->timestamp('atualizado_em')->default(now());
            $table->timestamp('finalizado_em')->nullable();
        });

        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->string('imagem')->nullable();
            $table->string('video')->nullable();
            $table->string('equipamento')->nullable();
        });

        Schema::create('exercicio_treino', function (Blueprint $table) {
            $table->foreignId('exercicio_id')->constrained('exercicios')->cascadeOnDelete();
            $table->foreignId('treino_id')->constrained('treinos')->cascadeOnDelete();
            $table->integer('series')->default(1);
        });

        Schema::create('grupos_musculares', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
        });

        Schema::create('exercicio_grupo_muscular', function (Blueprint $table) {
            $table->foreignId('exercicio_id')->constrained('exercicios')->cascadeOnDelete();
            $table->foreignId('grupo_muscular_id')->constrained('grupos_musculares')->cascadeOnDelete();
            $table->integer('intensidade')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno_treino');
        Schema::dropIfExists('exercicio_grupo_muscular');
        Schema::dropIfExists('exercicio_treino');
        Schema::dropIfExists('treinos');
        Schema::dropIfExists('exercicios');
        Schema::dropIfExists('grupos_musculares');
    }
};
