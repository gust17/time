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
        //
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
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function crianca(Cliente $cliente)
    {


        $servicos = Servico::all();



        return view('clientes.criancas', compact('cliente','servicos'));
    }
}
