<?php

namespace App\Http\Controllers\Enfermera;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Usuario;

use Carbon\Carbon;
use DB;

class GraficoController extends Controller
{

    public function citas(){
        $contadoresMensuales = Cita::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(1) as contador')
        )->groupBy('mes')->get()->toArray();

        $contadores = array_fill(0, 12, 0);

        foreach ($contadoresMensuales as $contadorMensual) {
            $indice = $contadorMensual['mes'] - 1;
            $contadores[$indice] = $contadorMensual['contador'];
        }

        return view('graficos.citas', compact('contadores'));
    }


    public function enfermeras()
    {
        $ahora = Carbon::now();
        $fin = $ahora->format('Y-m-d');
        $inicio = $ahora->subYear()->format('Y-m-d');
        return view('graficos.enfermeras', compact('inicio', 'fin'));
    }

    public function enfermerasJson(Request $request)
    {
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');

        $enfermeras = Usuario::enfermeras()
            ->select('nombre')
            ->withCount([
                'citasAtendidas' => function ($consulta) use ($inicio, $fin) {
                    $consulta->whereBetween('fecha_programada', [$inicio, $fin]);
                },
                'citasCanceladas' => function ($consulta) use ($inicio, $fin) {
                    $consulta->whereBetween('fecha_programada', [$inicio, $fin]);
                }
            ])
            ->orderBy('citas_atendidas_count', 'desc')
            ->take(5)
            ->get();

        $datos = [];
        $datos['categorias'] = $enfermeras->pluck('nombre');

        $series = [];
        // Citas atendidas
        $serie1['nombre'] = 'Citas atendidas';
        $serie1['datos'] = $enfermeras->pluck('citas_atendidas_count');
        // Citas canceladas
        $serie2['nombre'] = 'Citas canceladas';
        $serie2['datos'] = $enfermeras->pluck('citas_canceladas_count');

        $series[] = $serie1;
        $series[] = $serie2;

        $datos['series'] = $series;

        return $datos;
    }
}
