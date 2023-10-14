<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;



class Enfermera extends Model
{
    use SoftDeletes;

    protected $table = 'nurses';
    protected $fillable = [
        'especialidad',
        'curriculoVitae',
        'carga_Horaria',
        'person_id',

    ];


public function user()
{
    return $this->belongsTo(User::class);
}
public function persona()
{
    return $this->belongsTo(Persona::class);
}
}
