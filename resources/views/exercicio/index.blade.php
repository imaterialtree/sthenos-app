<x-template-layout>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-6">
            <h1>Exercicios</h1>
        </div>
        <div class="col-6">
            <div>
                <a href="{{ route('exercicio.create') }}">
                    <button class="btn btn-danger d-block ms-auto">Criar Exercicio</button>
                </a>
            </div>
        </div>
    </div>
    @if (empty($exercicios))
        <p>Nenhum Exercicio cadastrado</p>
    @else
        <div class="row mb-4">
            <div class="col-12">
                <table id="myTable" class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Equipamentos</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exercicios as $exercicio)
                            <tr>
                                <td scope="row">{{ $exercicio->id }}</td>
                                <td>{{ $exercicio->nome }}</td>
                                <td>{{ $exercicio->descricao }}</td>
                                @if ($exercicio->equipamento)
                                    <td>{{ $exercicio->equipamento }}</td>
                                @else
                                    <td>Sem necessidade de equipamentos.</td>
                                @endif
                                <td>
                                    <a href="{{ route('exercicio.edit', $exercicio->id) }}"
                                        class="me-2 btn btn-outline-dark"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('exercicio.show', $exercicio->id) }}"
                                        class="me-2 btn btn-outline-info"><i class="bi bi-eye"></i></a>
                                    @include('exercicio.partials.delete-exercicio-form')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-template-layout>
