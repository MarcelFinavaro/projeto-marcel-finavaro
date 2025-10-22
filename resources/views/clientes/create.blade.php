@extends('layouts.app') <!-- Se estiver usando um layout base -->

@section('content')
    <h1>Cadastrar Cliente</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}" required><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="{{ old('telefone') }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required><br>

        <button type="submit">Cadastrar</button>
    </form>
@endsection