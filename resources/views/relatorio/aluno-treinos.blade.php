<!-- resources/views/relatorio/progresso-treino.blade.php -->

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Progresso do Aluno {{ $aluno->user->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Relatório de Progresso de Treino</h1>

    <h2>Aluno: {{ $aluno->user->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Data de Nascimento</th>
                <th>Peso</th>
                <th>Altura</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $aluno->data_nascimento }}</td>
                <td>{{ $aluno->peso }}</td>
                <td>{{ $aluno->altura }}</td>
            </tr>
        </tbody>
    </table>

    <p><strong>Treinos concluídos:</strong> {{ $treinosConcluidos }} de {{ $totalTreinos }}</p>

    <table>
        <thead>
            <tr>
                <th>Treino</th>
                <th>Progresso (%)</th>
                <th>Exercícios Feitos</th>
                <th>Exercícios Totais</th>
                <th>Data Início</th>
                <th>Data Término</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($treinos as $treino)
                <tr>
                    <td>{{ $treino->nome }}</td>
                    <td>{{ $treino->pivot->progresso() }}%</td>
                    <td>{{ $treino->pivot->exercicios_feitos }}</td>
                    <td>{{ $treino->pivot->exercicios_totais }}</td>
                    <td>{{ $treino->pivot->criado_em->format('d-m-Y') }}</td>
                    <td>{{ $treino->pivot->finalizado_em?->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
