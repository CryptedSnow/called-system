<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Chamado extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'chamados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'empresa_id',
        'titulo',
        'descricao',
        'tipo_gravidade',
        'status',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

}
