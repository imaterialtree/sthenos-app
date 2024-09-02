<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AlunoController extends Controller
{
    public function update(Request $request, $aluno)
    {
        $aluno = Aluno::find($aluno);
        $validated = $request->validate([
            'data_nascimento' => 'required|date',
            'peso' => 'required|numeric|decimal:0,2',
            'altura' => 'required|numeric|integer',
        ]);
        $aluno->fill($validated);
        $aluno->save();

        return Redirect::route('profile.edit')->with('status', 'aluno-updated');
    }
}
