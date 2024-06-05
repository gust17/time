@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Cliente ja tem Cadastro?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <button class="btn btn-success w-50">SIM</button>
                            <button class="btn btn-danger w-50">NÃO</button>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('servicos.index')}}" class="btn btn-primary">Serviçoes</a>
                        <button>Clientes</button>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">Abrir Comanda
                        </button>
                        <button>Registros</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Criança</th>
                                <th>Tempo</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($consumos as $consumo)

                                <tr>
                                    <td>{{$consumo}}</td>
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
