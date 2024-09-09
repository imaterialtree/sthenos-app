@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Próximo Exercício do Treino: {{ $treino->nome }}</h2>

        <div>
            <h4>{{ $proximoExercicio->nome }}</h4>
            <p>{{ $proximoExercicio->descricao }}</p>

            <form action="{{ route('aluno.treino.concluir-exercicio', [$aluno, $treino]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Exercício Concluído</button>
            </form>
        </div>
    </div>
@endsection
