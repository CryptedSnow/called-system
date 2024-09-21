<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model,SoftDeletes};

class GravidadeModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'gravidades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo_gravidade'
    ];

    public function chamado()
    {
        return $this->hasMany(ChamadoModel::class, 'gravidade_id');
    }

}
