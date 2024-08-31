<x-template-layout>
    <h1>Crie um Exercicio</h1>
    <form action="{{ route('exercicio.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="mb-3">
            <label for="inome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inome" name="nome" placeholder="Flexão">
        </div>
        <div class="mb-3">
            <label for="idescricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="idescricao" name="descricao" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="iimagem" class="form-label">Imagem</label>
            <input class="form-control" type="file" id="iimagem" name="imagem">
        </div>
        <div class="mb-3">
            <label for="ivideo" class="form-label">Vídeo</label>
            <input class="form-control" type="file" id="ivideo" name="video">
        </div>
        <div class="mb-3">
            <label for="iequipamento" class="form-label">Equipamento</label>
            <input type="text" class="form-control" id="iequipamento" name="equipamento" placeholder="Flexão">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-danger">Criar Exercicio</button>
        </div>
    </form>
</x-template-layout>