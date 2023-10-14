<?php

namespace App\Http\Controllers\Enfermera;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JornadaLaboral;
use Carbon\Carbon;

class HorarioController extends Controller
{
   private $dias = [
        'Lunes', 'Martes', 'Miércoles',
        'Jueves', 'Viernes', 'Sábado', 'Domingo'
    ];

    public function edit(){
        $jornadasLaborales = JornadaLaboral::where('enfermera_id', auth()->id())->get();

        if (count($jornadasLaborales) > 0) {
            $jornadasLaborales->map(function ($jornadaLaboral)
            {
                $jornadaLaboral->inicio_manana = (new Carbon($jornadaLaboral->inicio_manana))->format('g:i A');
                $jornadaLaboral->fin_manana = (new Carbon($jornadaLaboral->fin_manana))->format('g:i A');
                $jornadaLaboral->inicio_tarde = (new Carbon($jornadaLaboral->inicio_tarde))->format('g:i A');
                $jornadaLaboral->fin_tarde = (new Carbon($jornadaLaboral->fin_tarde))->format('g:i A');
                return $jornadaLaboral;
            });
        } else {
            $jornadasLaborales = collect();
            for ($i=0; $i<7; ++$i)
                $jornadasLaborales->push(new JornadaLaboral());
        }

        $dias = $this->dias;

        return view('horario', compact('jornadasLaborales', 'dias'));
    }

    public function store(Request $request){

        $activas = $request->input('activas') ?: [];
        $inicio_manana = $request->input('inicio_manana');
        $fin_manana = $request->input('fin_manana');
        $inicio_tarde = $request->input('inicio_tarde');
        $fin_tarde = $request->input('fin_tarde');

        $errores = [];

        for ($i=0; $i < 7; $i++){
            if ($inicio_manana[$i] > $fin_manana[$i]) {
                $errores []= 'Las horas de la mañana son inconsistentes para el día ' . $this->dias[$i] . '.';
            }
            if ($inicio_tarde[$i] > $fin_tarde[$i]) {
                $errores []= 'Las horas de la tarde son inconsistentes para el día ' . $this->dias[$i] . '.';
            }
            JornadaLaboral::updateOrCreate(
                [
                    'dia' => $i,
                    'user_id' => auth()->id()
                ],
                [
                    'activo' => in_array($i, $activas),
                    'inicio_manana' => $inicio_manana[$i],
                    'fin_manana' => $fin_manana[$i],
                    'inicio_tarde' => $inicio_tarde[$i],
                    'fin_tarde' => $fin_tarde[$i]
                ]
            );
        }

        if (count($errores) > 0)
            return back()->with(compact('errores'));

        $notificacion = 'Los cambios se han guardado correctamente.';
        return back()->with(compact('notificacion'));
    }
}
