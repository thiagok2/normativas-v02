<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'termos', 'data_consulta'
    ];
}
