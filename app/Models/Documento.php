<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'normativa_id',
        'nombre_archivo',
        'ruta_archivo',
        'version',
        'uploaded_at',
        'uploaded_by',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    public function normativa()
    {
        return $this->belongsTo(Normativa::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function versiones()
    {
        return $this->hasMany(DocumentoVersion::class);
    }
}
