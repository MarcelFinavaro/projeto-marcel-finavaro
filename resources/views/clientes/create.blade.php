@extends('layouts.app')

@section('content')
    <h1>Cadastrar Novo Cliente</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" value="{{ old('nome') }}"><br><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" name="telefone" value="{{ old('telefone') }}"><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <button type="submit">Salvar</button>
    </form>
@endsection