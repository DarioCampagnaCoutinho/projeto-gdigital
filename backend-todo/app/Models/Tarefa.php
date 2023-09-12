<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'data_vencimento',
        'status',
    ];

    public function subtarefas()
    {
        return $this->hasMany(SubTarefa::class)->latest();
    }
}
