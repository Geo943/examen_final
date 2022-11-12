<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_empleado', 'tipo','fecha', 'hora'
    ];
}
