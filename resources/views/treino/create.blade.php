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
    <h1>Crie um Treino</h1>
    <form action="{{ route('treino.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Nome e Descrição --}}
        <div class="form-group mb-3">
            <label for="nome">Nome do Treino</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome"
                value="{{ old('nome') }}">
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="idescricao" class="form-label">Descrição</label>
            <textarea class="form-control @error('descricao') is-invalid @enderror" id="idescricao" name="descricao" rows="3" 
                required>{{ old('descricao') }}</textarea>
            @error('descricao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Exercícios --}}

        <div class="row">
            <!-- Lista de Exercícios Disponíveis -->
            <div class="col-md-6">
                <h5>Exercícios Disponíveis</h5>
                <ul class="list-group" id="exerciciosDisponiveis">
                    @foreach ($exercicios as $exercicio)
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
                    @foreach (old('exercicios', []) as $index => $exercicio)
                        @php $contadorExercicio++; @endphp

                        <li class="list-group-item">
                            {{ $exercicios->find($exercicio['id'])->nome }}
                            <div class="float-end">
                                <input type="number" name="exercicios[{{ $index }}][repeticoes]" placeholder="Repetições"
                                class="form-control @error("exercicios.{$index}.repeticoes") is-invalid @enderror" 
                                    value="{{ $exercicio['repeticoes'] }}"  required>

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

        {{-- Botão de salvar --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-danger">Criar treino</button>
        </div>
    </form>
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
        <input type="number" name="exercicios[${contadorExercicio}][repeticoes]" class="form-control-sm float-end" placeholder="Repetições" required>
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
