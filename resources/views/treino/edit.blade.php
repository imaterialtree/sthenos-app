@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h1>Editar Treino</h1>

        <form action="{{ route('treino.update', $treino->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nome do Treino -->
            <div class="form-group mb-3">
                <label for="nome">Nome do Treino</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome"
                    value="{{ old('nome', $treino->nome) }}">
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Descrição do Treino -->
            <div class="form-group mb-3">
                <label for="descricao">Descrição do Treino</label>
                <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao">{{ old('descricao', $treino->descricao) }}</textarea>
                @error('descricao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Exercícios --}}

            <div class="row">
                <!-- Lista de Exercícios Disponíveis -->
                <div class="col-md-6">
                    <h5>Exercícios Disponíveis</h5>
                    <ul class="list-group" id="exerciciosDisponiveis">
                        @foreach ($todosExercicios as $exercicio)
                            <li class="list-group-item">
                                {{ $exercicio->nome }}
                                <button type="button" class="btn btn-sm btn-primary float-end"
                                    onclick="adicionarExercicio({{ $exercicio->id }}, '{{ $exercicio->nome }}')">Adicionar</button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Lista de Exercícios Selecionados --}}
                <div class="form-group col-md-6">
                    <h5>Exercícios Escolhidos</h5>
                    <ul class="list-group" id="exerciciosEscolhidos">
                        {{-- Exercícios escolhidos aparecerão aqui dinamicamente --}}

                        {{-- Preencher os valores antigos --}}
                        @php $contadorExercicio = -1; @endphp
                        @foreach (old('exercicios', $treino->exercicios) as $index => $exercicio)
                            @php $contadorExercicio++; @endphp

                            <li class="list-group-item">
                                {{-- Tenta pegar da model, senão resgata a partir do id do old value --}}
                                {{ $exercicio->nome ?? $todosExercicios->find($exercicio['id'])->nome }}
                                <div class="float-end">
                                    <input type="number" name="exercicios[{{ $index }}][repeticoes]"
                                        placeholder="Repetições"
                                        class="form-control @error("exercicios.{$index}.repeticoes") is-invalid @enderror"
                                        value="{{ $exercicio['repeticoes'] ?? $exercicio->pivot->repeticoes }}" required>

                                    @error("exercicios.{$index}.repeticoes")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="exercicios[{{ $index }}][id]"
                                    value="{{ $exercicio['id'] }}">
                                <button type="button" class="btn btn-sm btn-danger float-end me-2"
                                    onclick="removerExercicio(${contadorExercicio})">Remover
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    @error('exercicios')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Botões -->
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Salvar Treino</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Contador para identificar exercícios escolhidos de forma única
        let contadorExercicio = {{ Js::from($contadorExercicio) }};

        function adicionarExercicio(id, nome) {
            const exerciciosEscolhidos = document.getElementById('exerciciosEscolhidos');
            contadorExercicio++;

            let novoItem = document.createElement('li');
            novoItem.classList.add('list-group-item');
            novoItem.setAttribute('id', 'exercicioEscolhido_' + contadorExercicio);

            novoItem.innerHTML = `
        ${nome} 
        <div class="float-end">
        <input type="number" name="exercicios[${contadorExercicio}][repeticoes]" class="form-control" placeholder="Repetições" required>
        </div>
        <input type="hidden" name="exercicios[${contadorExercicio}][id]" value="${id}">
        <button type="button" class="btn btn-sm btn-danger float-end me-2" onclick="removerExercicio(${contadorExercicio})">Remover</button>
        `;
            exerciciosEscolhidos.appendChild(novoItem);
        }

        function removerExercicio(idNum) {
            const item = document.getElementById('exercicioEscolhido_' + idNum);
            item.remove();
        }
    </script>
@endpush
