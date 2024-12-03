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
                            <button type="button" class="btn btn-success w-50" data-bs-toggle="modal" data-bs-target="#abrirComanda">SIM</button>
                            <a href="{{route('clientes.create')}}" class="btn btn-danger w-50">NÃO</a>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal" id="abrirComanda">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Abrir comandas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('consumo.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Cliente</label>
                                <select name="cliente_id" id="cliente_id" class="form-control">
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Criança</label>
                                <select name="crianca_id" id="crianca_id" class="form-control">
                                    <option value="">Selecione uma criança</option>
                                    @foreach($criancas as $crianca)
                                        <option value="{{ $crianca->id }}" data-cliente="{{ $crianca->cliente_id }}">{{ $crianca->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Serviço</label>
                                <select name="servico_id" id="" class="form-control">
                                    @forelse($servicos as $servico)

                                        <option value="{{$servico->id}}">{{$servico->name}}</option>
                                    @empty
                                    @endforelse

                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success w-100">Gerar</button>
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
                    <div class="card-body">
                        <a href="{{route('servicos.index')}}" class="btn btn-primary">Serviços</a>
                        <a href="{{route('clientes.index')}}" class="btn btn-primary">Clientes</a>
                        <!--<a href="{{route('clientes.index')}}" class="btn btn-info">Relatórios</a> -->
                        <!--<a href="{{route('clientes.index')}}" class="btn btn-info">Registro</a> -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">+Novo</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Criança</th>
                                <th>Hora final</th>
                                <th>Contador</th>
                                <th>Ações</th>
                                <th>Finalizar</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($consumos as $consumo)

                                <tr>
                                    <td>{{ optional($consumo->cliente)->name }}</td>
                                    <td>{{ optional($consumo->crianca)->name }}</td>
                                    <td>{{ $consumo->created_at->addMinutes($consumo->totalTempo())->format('H:i:s') }}</td>
                                    <td>                    <span id="countdown_{{ $consumo->id }}">Calculando...</span>

                                    </td>
                                    <td>
                                    <a class="btn btn-primary w-20" href="{{ route('consumo.servico', ['consumo' => $consumo->id, 'servico' => $servico->id]) }}">{{ $servico->name }}</a>
                                    <form action="{{ route('consumo.destroy', $consumo->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta comanda?')">
                                    Excluir
                                    </button>
                                    </form>
                                    </td>

                                    <td>
                                    <form action="{{ route('consumo.destroy', $consumo->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza que deseja finalizar esta comanda?')">
                                    Finalizar comanda
                                    </button>
                                    </form>
                                    </td>


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

@section('js')
    <script>
        // Função para formatar o countdown
        function updateCountdown(endTime, elementId) {
            var timer = setInterval(function() {
                var now = new Date().getTime();
                var distance = endTime - now;

                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var formattedTime = ("0" + hours).slice(-2) + ":" + ("0" + minutes).slice(-2) + ":" + ("0" + seconds).slice(-2);

                document.getElementById(elementId).textContent = formattedTime;

                if (distance < 0) {
                    clearInterval(timer);
                    document.getElementById(elementId).textContent = "00:00:00";
                }
            }, 1000);
        }

        // Chama a função para iniciar o countdown para cada linha quando a página carregar
        document.addEventListener("DOMContentLoaded", function(event) {
            @foreach($consumos as $consumo)
            var endTime_{{ $consumo->id }} = new Date("{{ $consumo->created_at->addMinutes($consumo->totalTempo())->toDateTimeString() }}");
            var elementId_{{ $consumo->id }} = "countdown_{{ $consumo->id }}";
            updateCountdown(endTime_{{ $consumo->id }}, elementId_{{ $consumo->id }});
            @endforeach
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var clienteSelect = document.getElementById('cliente_id');
            var criancaSelect = document.getElementById('crianca_id');
            var criancasOptions = document.querySelectorAll('#crianca_id option');

            // Event listener para mudanças no select de Cliente
            clienteSelect.addEventListener('change', function() {
                var clienteId = this.value;

                // Limpa o select de Criança
                criancaSelect.innerHTML = '<option value="">Selecione uma criança...</option>';

                // Filtra e exibe apenas as opções de Criança do cliente selecionado
                criancasOptions.forEach(function(option) {
                    var dataClienteId = option.getAttribute('data-cliente');

                    if (dataClienteId === clienteId || dataClienteId === '') {
                        criancaSelect.appendChild(option.cloneNode(true));
                    }
                });
            });
        });
    </script>

@endsection
