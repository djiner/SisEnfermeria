<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\UsuarioController;
use App\Http\Controllers\Superadmin\EnfermeraController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\Enfermera\LocalizacionController;
use App\Http\Controllers\Enfermera\EspecialidadController;
use App\Http\Controllers\Enfermera\HorarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EvaluationNoteController;
use App\Http\Controllers\NotificationsController;

use App\Http\Controllers\ReportsController;
use App\Http\Controllers\WorkdaysController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web para la aplicación. Estas rutas se cargan
| mediante el middleware "web" y se asignan al grupo "web". ¡Haz algo genial!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
        // Rutas de usuario
        Route::resource('usuarios', UsuarioController::class);
        // Rutas de enfermeras
        Route::resource('enfermeras', EnfermeraController::class);
           // Ruta para mostrar las horas de horario
        Route::get('horario', [HorarioController::class, 'edit']);
        Route::post('horario', [HorarioController::class, 'store']);
        Route::resource('localizacion', LocalizacionController::class);
        Route::resource('especialidades', EspecialidadController::class);
        Route::get('reservarcitas/create', [CitaController::class, 'create']);
        Route::post('reservarcitas', [CitaController::class, 'store']);
        Route::get('miscitas', [CitaController::class, 'index']);
        Route::get('miscitas/{citas}', [CitaController::class, 'show']);
        Route::post('miscitas/{citas}/cancel', [CitaController::class, 'cancel']);
        Route::post('miscitas/{citas}/confirm', [CitaControllerr::class, 'confirm']);
        Route::get('/miscitas/{citas}/cancel', [CitaController::class, 'formCancel']);
     //JSON
     Route::get('/especialidades/{specialty}/Enfermera', [App\Http\Controllers\Api\SpecialtyController::class, 'Enfermera']);
     Route::get('/horario/horas', [App\Http\Controllers\Api\HorarioController::class, 'horas']);

    //Rutas Reportes
    Route::get('/reportes/citas/line', [ChartController::class, 'appointments']);
    Route::get('/reportes/enfermera/column', [ChartController::class, 'enfermera']);

    Route::get('/reportes/enfermera/column/data', [ChartController::class, 'enfermeraJson']);

    // Rutas de usuario
    Route::resource('evaluacion', EvaluationNoteController::class);

    Route::resource('notificacion', NotificationsController::class);

    Route::resource('reportes', ReportsController::class);


});
