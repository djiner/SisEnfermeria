<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'appointments'; // Cambia el nombre de la tabla a 'appointments'

    protected $fillable = [
        'description',
        'specialties_id', // Cambia 'especialidad_id' a 'specialties_id'
        'nurses_id', // Cambia 'enfermera_id' a 'nurses_id'
        'patients_id',
        'horario_date',
        'horario_time',
        'type',
    ];

    // Relación con la especialidad
    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class, 'specialties_id'); // Cambia la clave foránea a 'specialties_id'
    }

    // Relación con la enfermera
    public function enfermera(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nurses_id'); // Cambia la clave foránea a 'nurses_id'
    }

    // Relación con el paciente
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patients_id');
    }

    // Relación con la cancelación de cita
    public function cancelar()
    {
        return $this->hasOne(cancelarcitas::class);
    }

    // Accesor para formatear la hora programada en formato 12 horas
    public function getScheduledTime12Attribute()
    {
        return (new Carbon($this->horario_time))->format('g:i A');
    }
}
