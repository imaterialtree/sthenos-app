<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Treino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AlunoController extends Controller
{
    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id);
        $validated = $request->validate([
            'data_nascimento' => 'required|date',
            'peso' => 'required|numeric|decimal:0,2',
            'altura' => 'required|numeric|integer',
        ]);
        $aluno->fill($validated);
        $aluno->save();

        return Redirect::route('profile.edit')->with('status', 'aluno-updated');
    }

    public function joinTreino($id)
    {
        $user = auth()->user();

        if ($user->instrutor) {
            return redirect()->back()->with('error', 'Usuário não permitido');
        }

        $aluno = $user->aluno;

        if (!$aluno) {
            return redirect()->back()->with('error', 'Aluno não encontrado');
        }

        $treino = Treino::with('exercicios')->find($id);
        $exercicios = $treino->exercicios;
        unset($treino['exercicios']);
        $aluno->treinos()->attach($id, ['exercicios_totais' => $treino->exercicios()->count()]);

        return redirect()->route('treino.show', compact('treino', 'exercicios'))->with('success', 'Cadastro em treino realizado com sucesso! Comece já!');
    }
}
