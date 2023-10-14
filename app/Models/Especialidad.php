<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Especialidad extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['nombre', 'descripcion']; // Campos que se pueden llenar.

    // $specialty->users
    public function users()
    {
    	return $this->belongsToMany(User::class,'specialties_user')->withTimestamps();
    }
}

