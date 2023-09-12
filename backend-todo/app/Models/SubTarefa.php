<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTarefa extends Model
{
    protected $fillable = [
        'tarefa_id',
        'descricao',
        'status',
    ];

    public function tarefas()
    {
        return $this->belongsTo(Tarefa::class);
    }
}
