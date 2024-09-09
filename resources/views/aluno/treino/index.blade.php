@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Treinos Disponíveis</h2>
        <ul>
            @foreach ($treinos as $treino)
                <li>
                    {{ $treino->nome }} - {{ $treino->descricao }}
                    <a href="{{ route('aluno.treino.iniciar', [$aluno, $treino]) }}" class="btn btn-primary">Começar</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
