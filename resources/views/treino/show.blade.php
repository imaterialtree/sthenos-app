@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
@endif
<div class="container">
    <h1>Detalhes do Treino</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $treino->nome }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $treino->descricao }}</p>

            <h4>Exercícios:</h4>
            @if ($treino->exercicios->isEmpty())
                <p>Esse treino não tem exercícios atribuídos.</p>
            @else
                <ul class="list-group">
                    @foreach ($treino->exercicios as $exercicio)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $exercicio->nome }} 
                            <span class="badge bg-primary rounded-pill">
                                Repetições: {{ $exercicio->pivot->repeticoes }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="card-footer">
            <a href="{{ route('treino.edit', $treino->id) }}" class="btn btn-outline-info">
                <i class="bi bi-pencil-square"></i> Editar Treino
            </a>
            <a href="{{ route('treino.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar para Lista de Treinos
            </a>
        </div>
    </div>
</div>
@endsection
