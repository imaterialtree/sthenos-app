<!-- resources/views/relatorio/sistema.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Sistema</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Relatório de Sistema</h1>

    <h2>Resumo</h2>
    <p><strong>Total de Alunos:</strong> {{ $totalAlunos }}</p>
    <p><strong>Total de Instrutores:</strong> {{ $totalInstrutores }}</p>

    <h2>Treinos</h2>
    <table>
        <thead>
            <tr>
                <th>ID do Treino</th>
                <th>Nome do Treino</th>
                <th>Descrição</th>
                <th>Número de Alunos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($treinos as $treino)
                <tr>
                    <td>{{ $treino->id }}</td>
                    <td>{{ $treino->nome }}</td>
                    <td>{{ $treino->descricao }}</td>
                    <td>{{ $treino->alunos_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
