<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Enfermera;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function appointments(){

        $monthCounts = Cita::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(1) as count'))
                ->groupBy('month')
                ->get()
                ->toArray();
        $counts = array_fill(0, 12, 0);
        foreach($monthCounts as $monthCount){
            $index = $monthCount['month']-1;
            $counts[$index] = $monthCount['count'];
        }

        return view('charts.appointments', compact('counts'));
    }

    public function enfermera(){
        $now = Carbon::now();
        $end = $now->format('Y-m-d');
        $start = $now->subYear()->format('Y-m-d');

        return view('charts.enfermera', compact('end', 'start'));
    }

    public function enfermeraJson(Request $request){

        $start = $request->input('start');
        $end = $request->input('end');

        $enfermera= enfermera::enfermera()
            ->select('name')
            ->withCount(['attendedAppointments' => function($query) use ($start, $end){
                $query->whereBetween(' horario_date', [$start, $end]);
            },
            'cancellAppointments'=> function($query) use ($start, $end){
                $query->whereBetween('horario_date', [$start, $end]);
            }
            ])
            ->orderBy('attended_appointments_count', 'desc')
            ->take(5)
            ->get();

        $data = [];
        $data['categories'] = $enfermera->pluck('name');

        $series = [];
        $series1['name'] = 'Citas atendidas';
        $series1['data'] = $enfermera->pluck('attended_appointments_count');
        $series2['name'] = 'Citas canceladas';
        $series2['data'] = $enfermera->pluck('cancell_appointments_count');

        $series[] = $series1;
        $series[] = $series2;
        $data['series'] = $series;

        return $data;
    }
}
