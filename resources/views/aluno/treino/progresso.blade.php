@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Treino: {{ $treino->nome }}</h2>

        <div>
            <h4>Exercício Atual</h4>
            <p>{{ $exercicios[$exerciciosFeitos]->nome }}</p>
            <p>{{ $exercicios[$exerciciosFeitos]->descricao }}</p>

            <form action="{{ route('aluno.treino.concluir-exercicio', [$aluno, $treino]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Exercício Concluído</button>
            </form>
        </div>
    </div>
@endsection
