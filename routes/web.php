<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\EnfermeraController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\LocalizacionController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Enfermera\HorarioController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');




//rutas especialidades
Route::resource('especialidades', EspecialidadController::class);

//rutas de usuario
Route::resource('usuarios', UsuarioController::class);
//rutas de usuario
Route::resource('enfermeras', EnfermeraController::class);
//rutas de usuario
Route::post('/register', [App\Actions\Fortify\CreateNewUser::class, 'create'])
    ->middleware(['web']);







//rutas de CITAS
Route::get('citas', [App\Http\Controllers\CitaController::class,'index']);



//rutas de usuario
Route::resource('evaluacion', EvaluationNoteController::class);
//rutas de usuario
Route::resource('localizacion', LocationController::class);
//rutas de usuario
Route::resource('notificacion', NotificationsController::class);
//rutas de usuario
Route::resource('pagos', PaymentsController::class);
//rutas de usuario
Route::resource('reportes', ReportsController::class);
//rutas de usuario
Route::resource('triaje', TriageController::class);
//rutas de usuario
Route::resource('diatrabajo', WorkdaysController::class);

Route::resource('localizacion', LocalizacionController::class);

// Ruta para mostrar las horas de horario
Route::get('horario', [HorarioController::class, 'edit']);




});
