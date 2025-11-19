<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where('nome', 'like', '%'.$request->search.'%');
        }

        $clientes = $query->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string|unique:clientes,cpf',
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes,email',
        ]);

        Cliente::create([
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $cliente = Cliente::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'cpf' => 'required|string|unique:clientes,cpf,'.$cliente->id,
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes,email,'.$cliente->id,
        ]);

        $cliente->update([
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }

    public function buscarPorNome(Request $request)
    {
        $nome = $request->input('nome');

        $clientes = Cliente::where('user_id', auth()->id())
            ->where('nome', 'like', "%{$nome}%")
            ->get();

        return view('clientes.index', compact('clientes'));
    }

    public function buscarPorCpf(Request $request)
    {
        $cpf = $request->input('cpf');

        $cliente = Cliente::where('user_id', auth()->id())
            ->where('cpf', $cpf)
            ->first();

        if ($cliente) {
            return view('clientes.index', ['clientes' => [$cliente]]);
        }

        return redirect()->route('clientes.index')
            ->with('error', 'Cliente com o CPF informado não foi encontrado.');
    }
}
