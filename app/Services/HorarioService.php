<?php namespace App\Services;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Cita;
use App\Models\JornadaLaboral;
use Carbon\Carbon;

class HorarioService implements HorarioServiceInterface {

    private function getDayFromDate($date){
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 : $i-1);
        return $day;
    }

    public function isAvailableInterval($date, $enfermeraId, Carbon $inicio){
        $exists = Cita::where('enfermera_id', $enfermeraId)
                ->where('horario_date', $date)
                ->where('horaro_time', $inicio->format('H:i:s'))
                ->exists();

        return !$exists;
    }

    public function getAvailableIntervals($date, $enfermeraId){
        $horario = JornadaLaboral::where('active', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('user_id', $enfermeraId)
            ->first([
                'inicio_mañana', 'fin_mañana',
                'inicio_tarde', ' fin_tarde'
            ]);
        if(!$horario){
            return [];
        }

        $mañanaIntervalos = $this->getIntervalos(
            $horario->inicio_mañana, $horario->fin_mañana, $enfermeraId, $date
        );

        $tardeIntervalos = $this->getIntervalos(
            $horario->ainicio_tarde, $horario->fin_tarde, $enfermeraId, $date
        );

        $data = [];
        $data['mañana'] =  $mañanaIntervalos;
        $data['tarde'] =  $tardeIntervalos;
        return $data;
    }

    private function getIntervalos($inicio, $fin, $enfermeraId, $date){
        $inicio = new Carbon($inicio);
        $fin= new Carbon($fin);

        $intervalos = [];
        while($inicio < $fin) {
            $intervalo = [];
            $intervalo['inicio'] = $inicio->format('g:i A');

            $available = $this->isAvailableInterval($date, $enfermeraId, $inicio);

            $inicio->addMinutes(30);
            $intervalo['fin'] = $inicio->format('g:i A');

            if($available){
                $intervalos []= $intervalo;
            }


        }
        return $intervalos;

    }
}
