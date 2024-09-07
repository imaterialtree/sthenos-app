<x-template-layout>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-6">
            <h1>Treinos</h1>
        </div>
        <div class="col-6">
            <button class="btn btn-danger d-block ms-auto px-3" onclick="location.href='{{ route('treino.create') }}'">
                Criar Treino
            </button>
        </div>
    </div>
    @if ($treinos->isEmpty())
        <h4>Nenhum treino cadastrado</h4>
    @else
        <div class="row mb-4">
            <div class="col-12">
                <table id="myTable" class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Alunos</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($treinos as $treino)
                            <tr>
                                <td scope="row">{{ $treino->id }}</td>
                                <td>{{ $treino->nome }}</td>
                                <td>{{ $treino->descricao }}</td>
                                <td>{{ 'Quantidade de ALunos' }}</td>
                                <td>
                                    <a href="{{ route('treino.edit', $treino->id) }}"
                                        class="me-2 btn btn-outline-dark"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('treino.show', $treino->id) }}"
                                        class="me-2 btn btn-outline-info"><i class="bi bi-eye"></i></a>
                                    @include('treino.partials.delete-treino-form')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-template-layout>
