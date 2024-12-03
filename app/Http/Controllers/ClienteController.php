<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Servico;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->name = $request->input('name');
        $cliente->telefone = $request->input('telefone');
        $cliente->save();
        return redirect()->route('clientes.crianca', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view("clientes.edit", compact("cliente"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'telefone' => 'required|numeric|min:11',
    ]);

    $cliente->update($validated);

    return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        // Buscar o serviço pelo ID
        $cliente = Cliente::findOrFail($id);
    
        // Verificar se o cliente está sendo utilizado em uma comanda (na tabela consumo_servico)
        $isUsed = $cliente->consumos()->exists();  // Verifica se há registros relacionados
    
        if ($isUsed) {
            // Se o cliente está sendo utilizado, redireciona com uma mensagem de erro
            return redirect()->route('clientes.index')->with('error', 'Este cliente não pode ser excluído porque está sendo usado em uma comanda.');
        }
    
        // Excluir o serviço se não estiver sendo utilizado
        $cliente->delete();
    
        // Redirecionar com uma mensagem de sucesso
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

    public function crianca(Cliente $cliente)
    {
        $servicos = Servico::all();
        return view('clientes.criancas', compact('cliente','servicos'));
    }
}
