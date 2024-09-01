<button class="btn btn-outline-danger" type="button" data-bs-toggle="modal"
    data-bs-target="#deleteExercicioModal{{ $exercicio->id }}">
    <i class="bi bi-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="deleteExercicioModal{{ $exercicio->id }}" tabindex="-1"
    aria-labelledby="deleteExercicioModalLabel{{ $exercicio->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteExercicioModalLabel{{ $exercicio->id }}">
                    {{ __('Tem certeza que deseja excluir esse exercício?') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    {{ __('Ao apagar esse exercicio, seus dados serão permanentemente apagados. Isso pode afetar treinos que possuem esse exercício!') }}
                </div>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('exercicio.destroy', $exercicio->id) }}" class="p-6">
                    @csrf
                    @method('delete')

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('Cancelar') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ __('Excluir Exercício') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
