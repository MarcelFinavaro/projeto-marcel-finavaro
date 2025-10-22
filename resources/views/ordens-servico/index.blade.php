@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ordens de Serviço</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ordens-servico.create') }}" class="btn btn-primary mb-3">Nova Ordem de Serviço</a>

    @if ($ordens->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Veículo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordens as $ordem)
                    <tr>
                        <td>{{ $ordem->id }}</td>
                        <td>{{ $ordem->descricao }}</td>
                        <td>{{ \Carbon\Carbon::parse($ordem->data)->format('d/m/Y') }}</td>
                        <td>{{ $ordem->veiculo->placa }} - {{ $ordem->veiculo->modelo }}</td>
                        <td>
                            <a href="{{ route('ordens-servico.edit', $ordem->id) }}" class="btn btn-sm btn-warning">Editar</a>

                            <form action="{{ route('ordens-servico.destroy', $ordem->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhuma ordem de serviço cadastrada.</p>
    @endif
</div>
@endsection