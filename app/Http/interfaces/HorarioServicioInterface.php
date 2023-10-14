<?php

namespace App\Interfaces;

use Carbon\Carbon;

interface HorarioServicioInterface
{
    public function isAvailableInterval($fecha, $enfermeraId, Carbon $inicio);
    public function getAvailableIntervals($fecha, $enfermeraId);
}
