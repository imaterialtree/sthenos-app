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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('tipo');
            $table->string('foto');
        });

        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->onDelete('cascade');
            $table->date('data_nascimento');
            $table->decimal('peso', 3, 2);
            $table->decimal('altura', 3, 2);
        });

        Schema::create('instrutores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->onDelete('cascade');
        });

        Schema::create('qualificacoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nivel');
        });

        Schema::create('instrutor_qualificacao', function (Blueprint $table) {
            $table->foreignId('instrutor_id')->constrained('instrutores');
            $table->foreignId('qualificacao_id')->constrained('qualificacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropar colunas criadas
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->dropColumn('foto');
        });
        // Dropar tabelas criadas
        Schema::dropIfExists('alunos');
        Schema::dropIfExists('instrutores');
        Schema::dropIfExists('qualificacoes');
        Schema::dropIfExists('instrutor_qualificacao');
    }
};
