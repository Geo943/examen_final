<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calculovelocidad extends Model
{
    use HasFactory;
    protected $fillable = [
        'metros', 'minutos','total'
    ];
}
