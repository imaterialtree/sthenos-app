<x-template-layout>
    <h1>Editar Exercicio</h1>
    <form action="{{ route('exercicio.update', $exercicio->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label for="inome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inome" name="nome" placeholder="Flexão" value="{{ $exercicio->nome }}">
        </div>
        <div class="mb-3">
            <label for="idescricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="idescricao" name="descricao" rows="3">{{ $exercicio->descricao }}</textarea>
        </div>
        <div class="mb-3">
            <label for="iimagem" class="form-label">Imagem</label>
            <input class="form-control" type="file" id="iimagem" name="imagem" value="{{ $exercicio->imagem }}">
        </div>
        <div class="mb-3">
            <label for="ivideo" class="form-label">Vídeo</label>
            <input class="form-control" type="file" id="ivideo" name="video" value="{{ $exercicio->video }}">
        </div>
        <div class="mb-3">
            <label for="iequipamento" class="form-label">Equipamento</label>
            <input type="text" class="form-control" id="iequipamento" name="equipamento" placeholder="Flexão" value="{{ $exercicio->equipamento }}">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-danger">Editar Exercicio</button>
        </div>
    </form>
</x-template-layout>