<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Consumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'crianca_id',
        'user_id',
        'cliente_id',
        'status'
    ];

    protected $table = 'consumo_servico';  // Caso a tabela tenha um nome diferente do padrão

    // Relacionamento com o modelo Servico
    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id');  // Chave estrangeira é 'servico_id'
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class);
    }

    public function totalTempo()
    {
        $tempos = $this->servicos;
        $result = 0;
        foreach ($tempos as $tempo) {
            $result += $tempo->tempo;
        }
        return $result;
    }

    public $timestamps = true;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }

    public function tempo()
    {
        $tempoTotal = $this->totalTempo();  // Obter o tempo total dos serviços
    
        // Garantir que 'created_at' seja uma instância de Carbon e não seja nulo
        $criado = $this->created_at;
    
        if (!$criado || !$criado instanceof Carbon) {
            // Inicialize com o valor atual se 'created_at' for nulo
            $criado = Carbon::now();
        }
    
        // Adicione os minutos ao valor de 'created_at'
        return $criado->addMinutes($tempoTotal);
    }
}
