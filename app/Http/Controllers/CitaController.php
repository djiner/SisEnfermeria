<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\CancelarCita;
use App\Models\Cita;
use App\Models\Especialidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{

    public function index(){

        $role = auth()->user()->role;

        if($role == 'admin'){
            //Admin
            $confirmarcitas = Cita::all()
            ->where('status', 'Confirmada');
            $pendientecitas = Cita::all()
            ->where('status', 'Reservada');
            $historialcitas = Cita::all()
            ->whereIn('status', ['Atendida','Cancelada']);
        }elseif($role == 'enfermera'){
            //Doctor
            $confirmarcitas = Cita::all()
            ->where('status', 'Confirmada')
            ->where('enfermera_id', auth()->id());
            $pendientecitas = Cita::all()
            ->where('status', 'Reservada')
            ->where('enfermera_id', auth()->id());
            $historialcitas = Cita::all()
            ->whereIn('status', ['Atendida','Cancelada'])
            ->where('enfermera_id', auth()->id());
        }elseif($role == 'paciente'){
            //Pacientes
            $confirmarcitas= Cita::all()
            ->where('status', 'Confirmada')
            ->where('patient_id', auth()->id());
            $pendientecitas = Cita::all()
            ->where('status', 'Reservada')
            ->where('patient_id', auth()->id());
            $historialcitas = Cita::all()
            ->whereIn('status', ['Atendida','Cancelada'])
            ->where('patient_id', auth()->id());
        }


        return view('citas.index',
        compact('confirmarcitas', 'pendientecitas', 'historialcitas', 'role') );
    }

    public function create(HorarioServiceInterface $horarioServiceInterface) {
        $specialties = Especialidad::all();

        $specialtyId = old('specialty_id');
        if ($specialtyId) {
            $specialty = Especialidad::find($specialtyId);
            $enfermeras = $specialty->users;
        } else {
            $especialidad = collect();
        }

        $date = old('horario_date');
        $enfermeraId = old('enfermera_id');
        if ($date && $enfermeraId) {
            $intervals = $horarioServiceInterface->getAvailableIntervals($date, $enfermeraId);
        }else {
            $intervals = null;
        }

        return view('citas.create', compact('specialties', 'enfermera', 'intervals'));
    }

    public function store(Request $request, HorarioServiceInterface $horarioServiceInterface) {

        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'enfermera_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialties,id'
        ];

        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Debe poner sus síntomas.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $horarioServiceInterface) {

            $date = $request->input('horario_date');
            $enfermeraId = $request->input('enfermera_id');
            $horario_time = $request->input('horario_time');
            if ($date && $enfermeraId && $horario_time) {
                $start = new Carbon($horario_time);
            }else {
                return;
            }

            if (!$horarioServiceInterface->isAvailableInterval($date, $enfermeraId, $start)) {
                $validator->errors()->add(
                    'available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->only([
            'horario_date',
            'horario_time',
            'type',
            'description',
            'nurse_id',
            'specialty_id'
        ]);
        $data['patient_id'] = auth()->id();

        $carbonTime = Carbon::createFromFormat('g:i A', $data['horario_time']);
        $data['horario_time'] = $carbonTime->format('H:i:s');

        Cita::create($data);

        $notification = 'La cita se ha realizado correctamente.';
        return redirect('/miscitas')->with(compact('notification'));
    }

    public function cancel(Cita $cita, Request $request) {

        if($request->has('justification')){
            $cancellation = new CancelarCita();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();

            $cita->cancellation()->save($cancellation);
        }

        $cita->status = 'Cancelada';
        $cita->save();
        $notification = 'La cita se ha cancelado correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
    }

    public function confirm(Cita $cita) {

        $cita->status = 'Confirmada';
        $cita->save();
        $notification = 'La cita se ha confirmado correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
    }

    public function formCancel(Cita $cita) {
        if($cita->status == 'Confirmada' || 'Reservada'){
            $role = auth()->user()->role;
            return view('citas.cancel', compact('cita', 'role'));
        }
        return redirect('/miscitas');

    }

    public function show(Cita $cita){
        $role = auth()->user()->role;
        return view('citas.show', compact('cita', 'role'));
    }
}
