<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JornadaLaboral extends Model
{
    use HasFactory;

    protected $table = 'work_days'; // Nombre correcto de la tabla
    protected $fillable = [
        'dia', // Cambiado de 'día' a 'dia'
        'activo', // Cambiado de 'activo' a 'activo'
        'inicio_manana',
        'fin_manana',
        'inicio_tarde',
        'fin_tarde',
        'enfermera_id'
    ];
}
