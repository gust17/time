@extends('layouts.app')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Cliente</span>
                        <a href="{{route('clientes.create')}}" class="btn btn-info">+Novo</a>
                        <a href="{{route('home')}}" class="btn btn-info">Voltar</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Telefone</th>
                                <th>Crianças cadastradas</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            
                            @forelse($clientes as $cliente)

                                <tr>
                                    <td>{{$cliente->name}}</td>
                                    <td>{{$cliente->telefone}}</td>
                                    <td>
                                    <a href="{{route('clientes.edit', $cliente->id)}}" type="button" class="btn btn-info">Editar</a>
                                    
                                    </td>
                                </tr>

                            @empty
                            <tr>
                                    <td colspan="3" class="text-center">Nenhum cliente encontrado.</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
