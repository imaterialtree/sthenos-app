@if($user->aluno)
<div class="card">
    <div class="card-header">{{ __('Informação do Aluno') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('aluno.update', $user->aluno) }}">
            @csrf
            @method('patch')

            <div class="row mb-3">
                <label for="dataNascimento" class="col-md-4 col-form-label text-md-end">
                    {{ __('Peso(kg)') }}
                </label>

                <div class="col-md-6">
                    <input id="dataNascimento" type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" 
                        value="{{ $user->aluno->data_nascimento }}" required autofocus autocomplete="data_nascimento">

                    @error('peso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="peso" class="col-md-4 col-form-label text-md-end">
                    {{ __('Peso(kg)') }}
                </label>

                <div class="col-md-6">
                    <input id="peso" type="number" min="0" step="0.01" class="form-control @error('peso') is-invalid @enderror" name="peso" 
                        value="{{ $user->aluno->peso }}" required autofocus autocomplete="peso">

                    @error('peso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="altura" class="col-md-4 col-form-label text-md-end">
                    {{ __('Altura(cm)') }}
                </label>

                <div class="col-md-6">
                    <input id="altura" type="number" class="form-control @error('altura') is-invalid @enderror" name="altura" value="{{ $user->aluno->altura }}" 
                        min="0" required autofocus autocomplete="altura">

                    @error('altura')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Salvar') }}
                    </button>
                    @if (session('status') === 'aluno-updated')
                        <span class="m-1 fade-out">{{ __('Salvo.') }}</span>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endif