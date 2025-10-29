<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'type',
        'entity_id',
        'prompt',
        'response',
        'predicted_at'
    ];

    public $timestamps = true;
}
