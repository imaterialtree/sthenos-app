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
        //
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

        $exercicio = Exercicio::make([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'equipamento' => $request->equipamento,
        ]);

        $exercicio->storeArquivo($request->file('imagem'), 'imagem');
        $exercicio->storeArquivo($request->file('video'), 'video');
        return redirect()->route('home')->with('success', 'Exercício criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
