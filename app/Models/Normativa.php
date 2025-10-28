<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'area',
        'numero_documento',
        'fecha_emision',
        'fecha_vencimiento',
        'estado',
        'entidad_emisora',
        'responsable_id',
        'notas',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
    ];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
