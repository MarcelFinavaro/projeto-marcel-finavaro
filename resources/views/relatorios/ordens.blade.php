<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Ordens de Serviço</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Relatório de Ordens de Serviço</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Veículo</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordens as $ordem)
                <tr>
                    <td>{{ $ordem->id }}</td>
                    <td>{{ $ordem->cliente->nome ?? '—' }}</td>
                    <td>{{ $ordem->veiculo->placa ?? '—' }}</td>
                    <td>{{ $ordem->descricao }}</td>
                    <td>{{ \Carbon\Carbon::parse($ordem->data_servico)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>