<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Treino;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlunoTreinoController extends Controller
{
    public function iniciarTreino(Aluno $aluno, Treino $treino)
    {
        $exercicios = $treino->exercicios;
        $exerciciosFeitos = $treino->pivot->exercicios_feitos;

        return view('aluno.treino-progresso', compact('treino', 'exercicios', 'exerciciosFeitos'));
    }

    public function concluirExercicio(Request $request, Aluno $aluno, Treino $treino)
    {
        // Atualiza a contagem de exercícios feitos
        $treinoPivot = $aluno->treinos()->where('treino_id', $treino->id)->first()->pivot;
        $treinoPivot->exercicios_feitos += 1;

        // Verifica se todos os exercícios foram concluídos
        if ($treinoPivot->exercicios_feitos >= $treinoPivot->exercicios_totais) {
            $treinoPivot->finalizado_em = Carbon::now(); // Atualiza a timestamp de finalização
        }

        $treinoPivot->save(); // Salva o progresso no banco de dados

        // Redireciona para o próximo exercício ou finaliza o treino
        if ($treinoPivot->exercicios_feitos < $treinoPivot->exercicios_totais) {
            return redirect()->route('aluno.treino.proximo-exercicio', [$aluno, $treino]);
        } else {
            return redirect()->route('aluno.treino.concluido', [$aluno, $treino]);
        }
    }

    public function proximoExercicio(Aluno $aluno, Treino $treino)
    {
        $treinoPivot = $aluno->treinos()->where('treino_id', $treino->id)->first()->pivot;
        $exercicios = $treino->exercicios;

        // Pega o próximo exercício com base nos exercícios feitos
        $proximoExercicio = $exercicios[$treinoPivot->exercicios_feitos];

        return view('aluno.proximo-exercicio', compact('aluno', 'treino', 'proximoExercicio'));
    }

    public function treinoConcluido(Aluno $aluno, Treino $treino)
    {
        return view('aluno.treino-concluido', compact('aluno', 'treino'));
    }
}
