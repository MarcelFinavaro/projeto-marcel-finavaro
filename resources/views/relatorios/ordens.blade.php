<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Ordens de Serviço</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 40px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .logo {
            width: 150px;
            height: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .assinatura {
            margin-top: 80px;
            display: flex;
            justify-content: space-between;
        }
        .assinatura div {
            width: 45%;
            text-align: center;
        }
        .linha {
            border-top: 1px solid #333;
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logotipo" class="logo">
        <div>
            <h2>Relatório de Ordens de Serviço</h2>
            <p>Gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Veículo</th>
                <th>Descrição</th>
                <th>Data do Serviço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordens as $ordem)
                <tr>
                    <td>{{ $ordem->id }}</td>
                    <td>
                        @if($ordem->cliente)
                            {{ $ordem->cliente->nome }} ({{ $ordem->cliente_cpf }})
                        @else
                            <em>Cliente não encontrado</em>
                        @endif
                    </td>
                    <td>
                        @if($ordem->veiculo)
                            {{ $ordem->veiculo->placa }} - {{ $ordem->veiculo->modelo }}
                        @else
                            <em>Veículo não encontrado</em>
                        @endif
                    </td>
                    <td>{{ $ordem->descricao }}</td>
                    <td>{{ \Carbon\Carbon::parse($ordem->data_servico)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="assinatura">
        <div>
            <div class="linha"></div>
            <p>Assinatura do Responsável</p>
        </div>
        <div>
            <div class="linha"></div>
            <p>Assinatura do Cliente</p>
        </div>
    </div>

    <div class="footer">
        Este relatório foi gerado automaticamente pelo sistema.
    </div>
</body>
</html>