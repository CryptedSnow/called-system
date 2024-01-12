<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChamadoModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'chamados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'empresa_id',
        'titulo',
        'descricao',
        'gravidade_id',
        'status',
    ];

    public function empresa()
    {
        return $this->belongsTo(EmpresaModel::class, 'empresa_id');
    }

    public function gravidade()
    {
        return $this->belongsTo(GravidadeModel::class, 'gravidade_id');
    }

}
