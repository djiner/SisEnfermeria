<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;



class Enfermera extends Model
{

    use SoftDeletes, HasFactory;

    protected $table = 'nurses';
    protected $fillable = [
        'especialidad_id',
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
        public function especialidad()
            {
                return $this->belongsTo(Especialidad::class, 'especialidad_id');
            }
}
