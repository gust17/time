<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;


    protected $fillable = [
      'crianca_id',
      'user_id',
      'cliente_id',
      'status'
    ];




    public function servicos()
    {
        return $this->belongsToMany(Servico::class);
    }

    public function totalTempo()
    {
        $tempos = $this->servicos;
        $result = 0;
        foreach ($tempos as $tempo) {
            $result+= $tempo->tempo;
        }
        return $result;
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function crianca()
    {
        return $this->belongsTo(Crianca::class);
    }

    public function tempo()
    {
        $tempoTotal = ($this->totalTempo());

        $criado = $this->attributes['created_at'];
        dd($criado->addMinutes($tempoTotal));
        return $this->attributes['created_at']->addMinutes($this->totalTempo);
    }
}
