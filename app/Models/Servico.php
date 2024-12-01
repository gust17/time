<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'valor',
        'tempo'
    ];

    // Modelo Servico
    public function consumos()
    {
        return $this->belongsToMany(Consumo::class);
    }

}
