<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'persons';
    protected $fillable = [

        'imagen',
        'nombres',
        'primer_Apellido',
        'segundo_Apellido',
        'ci',
        'fecha_Nacimiento',
        'direccion',
        'celular',
        'sexo',

    ];

    protected $dates = ['fecha_registro', 'fecha_actualizacion'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function enfermera(): HasOne
    {
        return $this->hasOne(Enfermera::class);
    }

    public function paciente(): HasOne
    {
        return $this->hasOne(Paciente::class);
    }
}
