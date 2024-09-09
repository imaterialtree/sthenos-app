@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Parabéns, você concluiu o treino: {{ $treino->nome }}!</h2>
        <p>Você completou todos os exercícios desse treino.</p>
        <a href="{{ route('aluno.treinos', $aluno) }}" class="btn btn-primary">Voltar para treinos</a>
    </div>
@endsection
