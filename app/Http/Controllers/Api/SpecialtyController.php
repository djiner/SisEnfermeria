<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;

use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function Enfermera(Especialidad $specialty){
        return $specialty->users()->get([
            'enfermera.id',
            'enfermera.name'
        ]);
    }
}
