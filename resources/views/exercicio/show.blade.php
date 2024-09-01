<x-template-layout>
<div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <h1>{{ $exercicio->nome }}</h1>
            <p>
                {{ $exercicio->descricao }}
            </p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            @if ($exercicio->imagem)
                <img src="{{ $exercicio->imagem }}" alt="Imagem">
            @else
            <p>Nenhuma imagem cadastrada.</p>
            @endif
            @if ($exercicio->video)
                <img src="{{ $exercicio->video }}" alt="Imagem">
            @else
            <p>Nenhum video cadastrada.</p>
            @endif
        </div>
    </div>
</x-template-layout>