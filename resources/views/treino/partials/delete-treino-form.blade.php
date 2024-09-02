<button class="btn btn-outline-danger" type="button" data-bs-toggle="modal"
    data-bs-target="#deleteTreinoModal{{ $treino->id }}">
    <i class="bi bi-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="deleteTreinoModal{{ $treino->id }}" tabindex="-1"
    aria-labelledby="deleteTreinoModalLabel{{ $treino->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteTreinoModalLabel{{ $treino->id }}">
                    {{ __('Tem certeza que deseja excluir esse treino?') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    {{ __('Ao apagar esse Treino, seus dados serão permanentemente apagados. Isso pode afetar usuários cadastrados nesse treino!') }}
                </div>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('treino.destroy', $treino->id) }}" class="p-6">
                    @csrf
                    @method('delete')

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('Cancelar') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ __('Excluir Treino') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
