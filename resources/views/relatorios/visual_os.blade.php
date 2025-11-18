<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h2, h3, h4 { margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        .assinatura { margin-top: 50px; }
        .logo { width: 140px; margin-bottom: 20px; }
    </style>
</head>
<body>
    {{-- Logotipo da oficina --}}
    <img src="{{ public_path('images/logo.png') }}" alt="Logo da Oficina" class="logo">

    <h2>Relatório de Ordem de Serviço</h2>

    <h3>Dados da Oficina</h3>
    <p>
        Oficina Modelo LTDA<br>
        CNPJ: 00.000.000/0001-00<br>
        Endereço: Rua Exemplo, 123<br>
        Telefone: (51) 99999-9999<br>
        Email: contato@oficina.com
    </p>

    <h3>Dados do Cliente</h3>
    <p>
        Nome: {{ $ordem->veiculo->cliente->nome }}<br>
        CPF: {{ $ordem->veiculo->cliente->cpf }}<br>
        Telefone: {{ $ordem->veiculo->cliente->telefone }}
    </p>

    <h3>Dados do Veículo</h3>
    <p>
        Placa: {{ $ordem->veiculo->placa }}<br>
        Modelo: {{ $ordem->veiculo->modelo }}<br>
        Marca: {{ $ordem->veiculo->marca }}<br>
        Ano: {{ $ordem->veiculo->ano }}
    </p>

    <h3>Dados da OS</h3>
    <p>
        OS Nº: {{ $ordem->id }}<br>
        Data: {{ \Carbon\Carbon::parse($ordem->data_servico)->format('d/m/Y') }}<br>
        Descrição: {{ $ordem->descricao }}<br>
        Mão de Obra: R$ {{ number_format($ordem->mao_obra, 2, ',', '.') }}
    </p>

    <h4>Peças Utilizadas</h4>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Qtd</th>
                <th>Valor Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = $ordem->mao_obra; @endphp
            @foreach ($ordem->pecas as $peca)
                @php
                    $subtotal = $peca->quantidade * $peca->preco_unitario;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $peca->nome_peca }}</td>
                    <td>{{ $peca->quantidade }}</td>
                    <td>R$ {{ number_format($peca->preco_unitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Geral: R$ {{ number_format($total, 2, ',', '.') }}</h4>

    <div class="assinatura">
        <p>__________________________________________<br>Assinatura do Cliente</p>
        <p>Data: ____/____/______</p>
    </div>
</body>
</html>