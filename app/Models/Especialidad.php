<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Especialidad extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['nombre', 'descripcion']; // Campos que se pueden llenar.

        public function enfermera()
    {
        return $this->hasMany(Enfermera::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

