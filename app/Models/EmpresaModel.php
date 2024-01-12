<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome_fantasia',
        'cnpj_empresa',
    ];

    public function chamado()
    {
        return $this->hasMany(ChamadoModel::class, 'empresa_id');
    }

}
