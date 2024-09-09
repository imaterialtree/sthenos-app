<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Instrutor;
use App\Models\Treino;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelatorioController extends Controller
{
    public function index()
    {
        $alunos = Aluno::all();
        return view('relatorio.index', compact('alunos'));
    }

    public function alunoTreinos(Request $request)
    {
        $aluno = Aluno::find($request->get('alunoId'));
        if (! $aluno) {
            abort(404, 'Não existe aluno com esse id');
        }
        if (! Auth::user()->instrutor && Auth::user()->aluno != $aluno) {
            abort(403);
        }
        $treinos = $aluno->treinos()->get();

        // Calcular progresso e outros detalhes
        $dadosRelatorio = [
            'aluno' => $aluno,
            'treinos' => $treinos,
            'totalTreinos' => $treinos->count(),
            'treinosConcluidos' => $treinos->filter(fn($treino) => $treino->pivot->exercicios_feitos === $treino->pivot->exercicios_totais)->count(),
        ];

        // Gerar PDF com Blade
        $pdf = PDF::loadView('relatorio.aluno-treinos', $dadosRelatorio);

        return $pdf->stream('relatorio-aluno-treinos.pdf');
    }

    public function sistema()
    {
        // Contar a quantidade de alunos e instrutores
        $totalAlunos = Aluno::count();
        $totalInstrutores = Instrutor::count();

        // Obter todos os treinos e contar o número de alunos em cada treino
        $treinos = Treino::withCount('alunos')->get();

        // Dados para o relatório
        $dadosRelatorio = [
            'totalAlunos' => $totalAlunos,
            'totalInstrutores' => $totalInstrutores,
            'treinos' => $treinos,
        ];

        // Gerar o PDF usando a view Blade
        $pdf = Pdf::loadView('relatorio.sistema', $dadosRelatorio);

        // Enviar o PDF para o navegador
        return $pdf->stream('relatorio-sistema.pdf');
    }
}
