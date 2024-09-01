@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Tipo de Usuário -->
                        <div class="row mb-3">
                            <label for="tipoUsuario" class="col-md-4 col-form-label text-md-end">Tipo de Usuário</label>
                            <div class="col-md-6">
                                <select class="form-control @error('tipoUsuario') is-invalid @enderror" id="tipoUsuario" name="tipoUsuario">
                                    <option>Selecione o tipo de usuário</option>
                                    <option value="aluno" @selected(old('tipoUsuario') == 'aluno')>Aluno</option>
                                    <option value="instrutor" @selected(old('tipoUsuario') == 'instrutor')>Instrutor</option>
                                </select>

                                @error('tipoUsuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr class="col-md-8 offset-md-2">

                        <!-- Campos adicionais para Aluno -->
                        <div id="camposAluno" class="collapse">
                            <div class="row mb-3">
                                <label for="dataNascimento" class="col-md-4 col-form-label text-md-end">Data de Nascimento</label>
                                <div class="col-md-6"><input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="{{ old('dataNascimento')}}"></div>
                            </div>
                            <div class="row mb-3">
                                <label for="peso" class="col-md-4 col-form-label text-md-end">Peso (kg)</label>
                                <div class="col-md-6"><input type="number" class="form-control" id="peso" placeholder="Digite seu peso" name="peso" value="{{ old('peso')}}"></div>
                            </div>
                            <div class="row mb-3">
                                <label for="altura" class="col-md-4 col-form-label text-md-end">Altura (cm)</label>
                                <div class="col-md-6"><input type="number" class="form-control" id="altura" placeholder="Digite sua altura" name="altura" value="{{ old('altura')}}"></div>
                            </div>
                        </div>

                        <!-- Campos adicionais para Instrutor -->
                        <div id="camposInstrutor" class="collapse">
                            <div class="form-group offset-md-4">
                                <label>Qualificações</label>
                                @foreach ($qualificacoes as $qualificacao)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="qualificacoes[]" value="{{ $qualificacao->id }}" id="qualificacao{{ $loop->index }}" 
                                        @if(old('qualificacoes')) @checked(in_array($qualificacao->id, old('qualificacoes'))) @endif>
                                        <label class="form-check-label" for="qualificacao{{ $loop->index }}">
                                            {{ $qualificacao->nome }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Já possui conta?') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function tryToggleExtraForm(tipoUsuario) {
        if (tipoUsuario === 'aluno') {
                $('#camposAluno').collapse('show');
                $('#camposInstrutor').collapse('hide');
            } else if (tipoUsuario === 'instrutor') {
                $('#camposInstrutor').collapse('show');
                $('#camposAluno').collapse('hide');
            } else {
                $('#camposAluno').collapse('hide');
                $('#camposInstrutor').collapse('hide');
            }
    }
    $(document).ready(function() {
        tryToggleExtraForm($('#tipoUsuario').val());
        $('#tipoUsuario').change(function() {
            tryToggleExtraForm($(this).val());
        });
    });
</script>
@endsection
