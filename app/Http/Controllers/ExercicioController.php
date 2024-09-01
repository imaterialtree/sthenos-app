<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Illuminate\Http\Request;

class ExercicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercicios = Exercicio::all();
        return view('exercicio.index', ['exercicios' => $exercicios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exercicio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'imagem' => 'nullable|file|image|max:4096',
            'video' => 'nullable|file|mimes:mp4,mov,avi,flv,mkv|max:'.(12*1024),
            'equipamento' => 'nullable|string|max:255',
        ]);

        $exercicio = Exercicio::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'equipamento' => $request->equipamento,
        ]);

        if ($request->hasFile('imagem')) {
            $exercicio->storeArquivo($request->file('imagem'), 'imagem');
        }
        if ($request->hasFile('video')) {
            $exercicio->storeArquivo($request->file('video'), 'video');
        }
        return redirect()->route('exercicio.index')->with('success', 'Exercício criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exercicio = Exercicio::find($id);
        return view('exercicio.show', ['exercicio' => $exercicio]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exercicio = Exercicio::find($id);
        return view('exercicio.edit', ['exercicio' => $exercicio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exercicio = Exercicio::find($id);
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'imagem' => 'nullable|file|image|max:4096',
            'video' => 'nullable|file|mimes:mp4,mov,avi,flv,mkv|max:'.(12*1024),
            'equipamento' => 'nullable|string|max:255',
        ]);

        $exercicio->nome = $request->nome;
        $exercicio->descricao = $request->descricao;
        $exercicio->equipamento = $request->equipamento;

        if ($request->hasFile('imagem')) {
            $exercicio->storeArquivo($request->file('imagem'), 'imagem');
        }
        if ($request->hasFile('video')) {
            $exercicio->storeArquivo($request->file('video'), 'video');
        }

        $exercicio->save();
        return redirect()->route('exercicio.index')->with('success', 'Exercício alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exercicio = Exercicio::find($id);
        $exercicio->delete();
        return redirect()->route('exercicio.index')->with('success', 'Exercício deletado com sucesso!');
    }
}
