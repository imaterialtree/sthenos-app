<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use App\Models\Treino;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class TreinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treinos = Treino::all();
        return view('treino.index', compact('treinos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exercicios = Exercicio::all(); // enviar exercicios para montar uma lista de opções
        return view('treino.create', compact('exercicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if (! $user->instrutor) {
            return redirect()->back()->with('error', 'Usuário não permitido');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'exercicios' => 'required|array|min:1',
            'exercicios.*.id' => 'integer|exists:exercicios,id',
            'exercicios.*.repeticoes' => 'integer|min:1',
        ], [
            'exercicios.required' => 'Você precisa selecionar pelo menos um exercício.',
            'exercicios.*.id.exists' => 'Que estranho. Um dos exercícios selecionados não existe no banco de dados. Tente novamente.',
            'exercicios.*.repeticoes.required' => 'Você deve especificar o número de repetições para cada exercício.',
            'exercicios.*.repeticoes.min' => 'O número mínimo de repetições é 1.',
        ]);

        $treino = $user->instrutor->treinos()->create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        // Salvar exercícios no treino
        foreach ($request->exercicios as $exercicio) {
            $treino->exercicios()->attach($exercicio['id'], ['series' => $exercicio['repeticoes']]);
        }

        return redirect()->route('treino.index')->with('success', 'Treino criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $treino = Treino::find($id);
        return view('treino.show', compact('treino'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $treino = Treino::find($id);
        $exercicios = Exercicio::all();
        return view('treino.edit', compact('treino', 'exercicios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $treino = Treino::find($id);
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'exercicios' => 'required|array|min:1',
            'exercicios.*' => 'integer|exists:exercicios,id',
        ]);
        $treino->fill($validated);
        $treino->save();
        $treino->exercicios()->sync($request->input('exercicios', []));

        return redirect()->route('treino.index')->with('success', 'Treino atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $treino = Treino::find($id);
        $treino->delete();
        return redirect()->route('treino.index')->with('success', 'Treino deletado com sucesso!');
    }
}
