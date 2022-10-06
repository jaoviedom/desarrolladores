<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desarrollador extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'direccion',
        'proyecto_id',
    ];
}
