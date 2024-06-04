@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('servicos.index')}}" class="btn btn-primary">Serviçoes</a>
                    <button>Clientes</button>
                    <button>Registros</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
