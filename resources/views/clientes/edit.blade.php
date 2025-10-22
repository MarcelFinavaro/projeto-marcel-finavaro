@extends('layouts.app') <!-- Se estiver usando um layout base -->

@section('content')
    <h1>Editar Cliente</h1>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome', $cliente->nome) }}" required><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $cliente->email) }}" required><br>

        <button type="submit">Atualizar</button>
    </form>
@endsection