@extends('layouts.app')

@section('content')
    <h1>Cadastrar Novo Veículo</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('veiculos.store') }}" method="POST">
        @csrf

        <label for="placa">Placa:</label><br>
        <input type="text" name="placa" value="{{ old('placa') }}"><br><br>

        <label for="modelo">Modelo:</label><br>
        <input type="text" name="modelo" value="{{ old('modelo') }}"><br><br>

        <label for="marca">Marca:</label><br>
        <input type="text" name="marca" value="{{ old('marca') }}"><br><br>

        <label for="ano">Ano:</label><br>
        <input type="number" name="ano" value="{{ old('ano') }}"><br><br>

        <label for="cliente_id">Cliente:</label><br>
        <select name="cliente_id">
            <option value="">Selecione um cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Salvar</button>
    </form>
@endsection