@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-5">Relatórios</h2>
                <div class="mb-4">

                    {{-- Sistema --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Gerar relatório do sistema</h2>
                        </div>

                        <div class="card-body p-0">
                            <div class="p-3">
                                <p><strong>Descrição:</strong>
                                    Exibe a quantidade de alunos e instrutores cadastrados, lista todos os treinos e mostra
                                    quantos alunos cada treino tem.
                                </p>
                            </div>
                            <a href="{{ route('relatorio.sistema') }}" class="btn btn-primary d-block">
                                Gerar relatório do sistema
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Aluno treinos --}}
                <div class="mb-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Gerar relatório de treinos do aluno</h2>
                        </div>

                        <div class="card-body p-0">
                            <div class="p-3">
                                <p><strong>Descrição:</strong>
                                    Exibe o progresso do aluno em cada treino, incluindo número de exercícios concluídos,
                                    repetições, data de início e fim.
                                </p>
                            </div>
                            <form action="{{ route('relatorio.aluno-treinos') }}" method="post">
                                @csrf
                                @if (Auth::user()->instrutor)
                                    <div class="m-3">
                                        <select class="form-control" name="alunoId">
                                            <option>Selecione o usuário</option>
                                            @foreach ($alunos as $aluno)
                                                <option value="{{ $aluno->id }}" @selected(old('alunoId') == 'aluno')>
                                                    #{{ $aluno->id }}: {{ $aluno->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" name="alunoId" value={{ Auth::user()->aluno->id }}>
                                @endif
                                <button class="btn btn-primary d-block w-100" type="submit">
                                    Gerar relatório de treinos do aluno
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
