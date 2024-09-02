<x-template-layout>
    <h1>Crie um Treino</h1>
    <form action="{{ route('treino.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="inome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inome" name="nome">
        </div>
        <div class="mb-3">
            <label for="idescricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="idescricao" name="descricao" rows="3"></textarea>
        </div>
        <div class="form-group mb-3">
            <div class="row">
                <div class="col-2"><label>Exercicios</label></div>
                <div class="col-2"><label>Repetições</label></div>
            </div>
            @foreach ($exercicios as $exercicio)
                <div class="row mb-2">
                    <div class="col-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="exercicios[]" value="{{ $exercicio->id }}"
                                id="exercicio{{ $loop->index }}"
                                @if (old('exercicios')) @checked(in_array($exercicio->id, old('exercicios'))) @endif>
                            <label class="form-check-label" for="exercicios{{ $loop->index }}">
                                {{ $exercicio->nome }}
                            </label>
                        </div>
                    </div>
                    <div class="col-2"><input type="number" class="form-control" name="serie"></div>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-danger">Criar treino</button>
        </div>
    </form>
</x-template-layout>
