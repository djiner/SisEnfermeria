<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class localizacion extends Model
{

    protected $table = 'locations';
    protected $fillable = [
        'nombre', 'Latitud', 'Longitud', 'direccion', 'zona', 'numeroCasa', 'calle'
    ];
}
