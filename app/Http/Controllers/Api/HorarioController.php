<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\HorarioServicioInterface;

use Carbon\Carbon;

class HorarioController extends Controller
{

    public function horas(Request $request, HorarioServicioInterface $horarioServicio)
    {
        $reglas = [
            'fecha' => 'required|date_format:"Y-m-d"',
            'id_enfermera' => 'required|exists:users,id'
        ];
        $request->validate($reglas);

        $fecha = $request->input('fecha');
        $enfermeraId = $request->input('id_enfermera');

        return $horarioServicio->getAvailableIntervals($fecha, $enfermeraId);
    }


    /*
    private function obtenerIntervalos($inicio, $fin) {
        $inicio = new Carbon($inicio);
        $fin = new Carbon($fin);

        $intervalos = [];

        while ($inicio < $fin) {
            $intervalo = [];

            $intervalo['inicio']  = $inicio->format('g:i A');
            $inicio->addMinutes(30);
            $intervalo['fin']  = $inicio->format('g:i A');

            $intervalos []= $intervalo;
        }

        return $intervalos;
    }
    */

}
