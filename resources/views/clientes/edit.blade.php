@extends('layouts.app')

@section('content')

        <!-- Tabela -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-services">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Clientes</span>

                        <a href="{{route('clientes.index')}}" class="btn btn-info">Voltar</a>
                    </div>

                    <div class="card-body-service">
                    <form id="serviceForm" action="{{route('clientes.update', $clientes)}}" method="post">
                    @csrf
                    @method("PUT")
                    <input type="hidden" id="clienteId" name="id"> 

                    <div class="form-group mt-3">
                        <label for="name">Nome</label>             <!-- o value com a variavel $cliente serve pra mostrar o atual, que está sendo mostrado-->
                        <input type="text" id="name" name="name" value="{{$cliente->name}}" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="telefone">Telefone</label>
                        <input type="number" id="tempo" name="tempo" value="{{$cliente->telefone}}" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success w-100">Salvar</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

