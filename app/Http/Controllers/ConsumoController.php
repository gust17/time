<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsumoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $consumo = new Consumo();
        $consumo->user_id = Auth::id();
        $consumo->crianca_id = $request->input('crianca_id');
        $consumo->cliente_id = $request->input('cliente_id');
        $consumo->save();

        $consumo->servicos()->attach($request->servico_id);

        return redirect(url('home'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumo $consumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumo $consumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumo $consumo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumo $consumo)
    {
        //
    }
}
