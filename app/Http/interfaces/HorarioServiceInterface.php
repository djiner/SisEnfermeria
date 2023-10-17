<?php namespace App\Interfaces;

use Carbon\Carbon;

interface HorarioServiceInterface {
    public function isAvailableInterval($date, $enfermeraId, Carbon $inicio);
    public function getAvailableIntervals($date, $enfermeraId);
}
