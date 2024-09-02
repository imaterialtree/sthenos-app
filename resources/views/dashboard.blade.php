@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($treinos as $treino)
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card" style="background-image: url('{{ asset('img/img-home.jpg')}}');">
                <div class="card-header border-0">{{ $treino->nome }}</div>

                <div class="card-body">
                    {{ $treino->descricao }}
                </div>

                <div class="card-footer">
                    <a href="{{ route('treino.show', $treino->id) }}"
                        class="me-2 btn btn-info"><i class="bi bi-eye">{{ __('Ver') }}</i></a>
                    <button class="btn btn-primary">
                        {{ __('Praticar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
