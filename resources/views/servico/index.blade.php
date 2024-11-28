@extends('layouts.app')

@section('content')

<!-- Modal +Novo / Editar -->
<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modalTitle">Serviços</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="serviceForm" method="post">
                    @csrf
                    <input type="hidden" id="serviceId" name="id"> <!-- Campo oculto para o ID -->

                    <div class="form-group mt-3">
                        <label for="name">Brinquedo</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tempo">Tempo</label>
                        <input type="number" id="tempo" name="tempo" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="valor">Valor</label>
                        <input type="number" id="valor" name="valor" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" id="modalSubmitButton" class="btn btn-success w-100">Salvar</button>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>

        </div>
    </div>
</div>
        <div class="container-modal">


        <!-- Tabela -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-services">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Serviços</span>

                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">+Novo</button>
                    </div>

                    <div class="card-body-service">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Serviço</th>
                                <th>Valor</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($servicos as $servico)

                                <tr>
                                    <td>{{$servico->name}}</td>
                                    <td>{{$servico->valor}}</td>
                                    <td>
                                    <button 
                                        type="button" 
                                        class="btn btn-info" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#myModal" 
                                        data-id="{{ $servico->id }}" 
                                        data-name="{{ $servico->name }}" 
                                        data-tempo="{{ $servico->tempo }}" 
                                        data-valor="{{ $servico->valor }}">
                                        Editar
                                    </button>
                                
                                        <!-- Botão de Excluir -->
                                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">
                                        Excluir
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('myModal');
    const modalTitle = document.getElementById('modalTitle');
    const serviceForm = document.getElementById('serviceForm');
    const modalSubmitButton = document.getElementById('modalSubmitButton');

    document.querySelectorAll('.btn-info[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const tempo = this.getAttribute('data-tempo');
            const valor = this.getAttribute('data-valor');

            // Preencher os campos do modal com os dados existentes
            document.getElementById('serviceId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('tempo').value = tempo;
            document.getElementById('valor').value = valor;

            // Alterar o título do modal para "Editar"
            modalTitle.textContent = 'Editar Serviço';
            serviceForm.action = `/servicos/${id}`; // URL para atualização
            serviceForm.method = 'POST';  // Usamos POST porque vamos simular o PATCH com _method

            // Criar campo oculto _method para simular PATCH
            let methodInput = serviceForm.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PATCH';
                serviceForm.appendChild(methodInput);
            }

            modalSubmitButton.textContent = 'Atualizar';
        });
    });

    // Resetar o modal para "Novo"
    modal.addEventListener('hidden.bs.modal', function () {
        modalTitle.textContent = 'Adicionar Serviço';
        serviceForm.action = "{{ route('servicos.store') }}"; // URL de criação
        serviceForm.method = 'POST';

        // Limpar campos do formulário
        document.getElementById('serviceId').value = '';
        document.getElementById('name').value = '';
        document.getElementById('tempo').value = '';
        document.getElementById('valor').value = '';

        const methodInput = serviceForm.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();

        modalSubmitButton.textContent = 'Salvar';
    });
});
</script>
@endsection
