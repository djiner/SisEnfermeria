<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Enfermera;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\HorarioServicioInterface;
use Carbon\Carbon;


class CitaController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role == 'admin') {
            $pendienteCitas = Cita::where('estado', 'Reservada')->paginate(15);
            $confirmarCitas = Cita::where('estado', 'Confirmada')->paginate(15);
            $historialCitas = Cita::whereIn('estado', ['Atendida', 'Cancelada'])->paginate(15);
        } elseif ($role == 'enfermera') {
            $userId = auth()->id();
            $pendienteCitas = Cita::where('estado', 'Reservada')->where('nurses_id', $userId)->paginate(15);
            $confirmarCitas = Cita::where('estado', 'Confirmada')->where('nurses_id', $userId)->paginate(15);
            $historialCitas = Cita::whereIn('estado', ['Atendida', 'Cancelada'])->where('nurses_id', $userId)->paginate(15);
        } elseif ($role == 'paciente') {
            $userId = auth()->id();
            $pendienteCitas = Cita::where('estado', 'Reservada')->where('patients_id', $userId)->paginate(15);
            $confirmarCitas = Cita::where('estado', 'Confirmada')->where('patients_id', $userId)->paginate(15);
            $historialCitas = Cita::whereIn('estado', ['Atendida', 'Cancelada'])->where('patients_id', $userId)->paginate(15);
        }

        return view('citas.index', compact('pendienteCitas', 'confirmarCitas', 'historialCitas', 'role'));
    }

public function create(HorarioServicioInterface $HorarioCitas)
{
    $specialties = Especialidad::all();
    $role = auth()->user()->role;

    $specialtyId = old('specialties_id');
    if ($specialtyId) {
        $specialty = Especialidad::find($specialtyId);
        $enfermeras = $specialty->users;
    } else {
        $enfermeras = collect();
    }

    $pacientes = User::Pacientes()->get();

    $date = old('horario_date');
    $enfermeraId = old('nurses_id');
    if ($date && $enfermeraId) {
        $intervals = $HorarioCitas->getAvailableIntervals($date, $enfermeraId);
    } else {
        $intervals = null;
    }

    return view('citas.create', compact('specialties', 'enfermeras', 'intervals', 'pacientes', 'role'));
}

public function store(Request $request, HorarioServicioInterface $HorarioCitas)
{
    $role = auth()->user()->role;

    if ($role == 'admin') {
        $rules = [
            'description' => 'required',
            'specialties_id' => 'exists:especialidads,id',
            'nurses_id' => 'exists:users,id',
            'patients_id' => 'exists:users,id',
            'horario_time' => 'required',
        ];
    } else {
        $rules = [
            'description' => 'required',
            'specialties_id' => 'exists:especialidads,id',
            'nurses_id' => 'exists:users,id',
            'horario_time' => 'required',
        ];
    }

    $messages = ['horario_time.required' => 'Por favor seleccione una hora válida para su cita'];

    $validator = Validator::make($request->all(), $rules, $messages);

    $validator->after(function ($validator) use ($request, $HorarioCitas) {
        $date = $request->input('horario_date');
        $enfermeraId = $request->input('nurses_id');
        $horario_time = $request->input('horario_time');
        if ($date && $enfermeraId && $horario_time) {
            $start = new Carbon($horario_time);
        } else {
            return;
        }

        if (!$HorarioCitas->isAvailableInterval($date, $enfermeraId, $start)) {
            $validator->errors()->add('available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.');
        }
    });

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    $data = $request->only([
        'description',
        'speciaties_id',
        'nurses_id',
        'horario_date',
        'horario_time',
        'type',
    ]);

    if ($role == 'admin') {
        $data['pacients_id'] = $request->input('pacients_id');
    } else {
        $data['pacients_id'] = auth()->id();
    }

    // Formato correcto para la hora
    $carbonTime = Carbon::createFromFormat('g:i A', $data['horario_time']);
    $data['horario_time'] = $carbonTime->format('H:i:s');
    Cita::create($data);
    $notification = 'La cita se ha registrado correctamente';
    return redirect('/citas')->with(compact('notification'));
}




   /*public function showCancelForm(Appointment $appointment)
    {
        if ($appointment->status == 'Confirmada') {
            $role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment', 'role'));
        }

        return redirect('/appointments');
    }

    public function postCancel(Appointment $appointment, Request $request)
    {
        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();
            // $cancellation->appointment_id = ;
            // $cancellation->save();

            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'Cancelada';
        $saved = $appointment->save(); // update

        if ($saved)
            $appointment->patient->sendFCM('Su cita ha sido cancelada.');

        $notification = 'La cita se ha cancelado correctamente.';
        return redirect('/appointments')->with(compact('notification'));
    }

    public function postConfirm(Appointment $appointment)
    {
        $appointment->status = 'Confirmada';
        $saved = $appointment->save(); // update

        if ($saved)
            $appointment->patient->sendFCM('Su cita se ha confirmado!');

        $notification = 'La cita se ha confirmado correctamente.';
        return redirect('/appointments')->with(compact('notification'));
    }


    public function show(citas $citas)
    {
        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment', 'role'));
    }*/


}
