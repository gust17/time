@extends('layouts.app')

@section('content')

    <div class="container">
        <!-- Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar Cliente</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('servicos.store')}}" method="post">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="">Serviço</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Tempo</label>
                                <input type="number" name="tempo" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Valor</label>
                                <input type="number" name="valor" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-success w-100">Cadastrar</button>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Cliente</span>

                        <a href="{{route('clientes.create')}}">+ Novo</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($clientes as $cliente)

                                <tr>
                                    <td>{{$cliente->name}}</td>
                                    <td>
                                        <button>Editar</button></td>
                                </tr>

                            @empty
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
