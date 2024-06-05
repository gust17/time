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
}
