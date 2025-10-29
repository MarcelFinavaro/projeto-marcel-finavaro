<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Lista todos os clientes
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', compact('clientes'));
    }

    // Exibe o formulário de cadastro
    public function create()
    {
        return view('clientes.create');
    }

    // Salva o cliente no banco
    public function store(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string|unique:clientes,cpf',
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes,email',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    // Exibe o formulário de edição
    public function edit($cpf)
    {
        $cliente = Cliente::findOrFail($cpf);

        return view('clientes.edit', compact('cliente'));
    }

    // Atualiza os dados do cliente
    public function update(Request $request, $cpf)
    {
        $cliente = Cliente::findOrFail($cpf);

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes,email,'.$cliente->cpf.',cpf',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    // Exclui o cliente
    public function destroy($cpf)
    {
        $cliente = Cliente::findOrFail($cpf);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

    // Busca cliente por nome
    public function buscarPorNome(Request $request)
    {
        $nome = $request->input('nome');

        $clientes = Cliente::where('nome', 'like', '%'.$nome.'%')->get();

        return view('clientes.index', compact('clientes'));
    }

    // Busca cliente por CPF
    public function buscarPorCPF(Request $request)
    {
        $cpf = $request->input('cpf');

        $clientes = Cliente::where('cpf', $cpf)->get();

        return view('clientes.index', compact('clientes'));
    }
}
