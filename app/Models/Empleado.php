<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_empleado','nombre', 'apellido', 'dpi', 'id_tipo_usuario', 'id_departamento','id_usuario', 'fecha_inicio_labores', 'fecha_nacimiento'
    ];
}
