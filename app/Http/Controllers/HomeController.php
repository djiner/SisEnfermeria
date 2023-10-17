<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Enfermera;
use App\Models\Especialidad;
use App\Models\Paciente;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $role = auth()->user()->role;

    $cardcitas = Cita::whereIn('status', ['Atendida', 'Confirmada'])->get()->count();
    $cardpaciente = Paciente::where('role', 'Patient')->get()->count();
    $cardenfermera = Enfermera::where('role', 'enfermera')->get()->count();
    $cardespecialidad = Especialidad::all()->count();

    if ($role == 'admin') {
        $confirmedAppointments = Cita::latest()->where('status', 'Confirmada')
            ->take(5)->get();
    } elseif ($role == 'enfermera') {
        $confirmedAppointments = Cita::latest()->where('status', 'Confirmada')
            ->where('enfermera_id', auth()->id())
            ->take(5)->get();
    } elseif ($role == 'patient') {
        $confirmedAppointments = Cita::latest()->where('status', 'Confirmada')
            ->where('patient_id', auth()->id())
            ->take(5)->get();
    }

    return view('dashboard', compact(
            'confirmarcitas',
            'role',
            'cardcitas',
            'cardpaciente',
            'cardenfermera',
            'cardespecialidad'
        ));
}



    public function editpaciente()
    {
        $id=auth()->user()->id;
     $paciente=Paciente::Patients()->findOrFail($id);
     return view('paciente.perfil',compact('paciente'));

    }


    public function updatepaciente(Request $request, $id)
    {
       $roles=[
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'dni' => 'digits:8'];

        $validatedData = $request->validate($roles,);

        $user=Paciente::Patients()->findOrFail($id);
        $data=$request->only('name','email','phone','address','dni');

        $password=$request->input('password');
            if ($password!=null){
                $data['password']=bcrypt($password);
            }

        $user->fill($data);
        $user->save();//UPDATE guardar cambios

        $notification='La informacion se ha actualizado correctamente';
        return redirect('/perfil/paciente')->with(compact('notification'));
    }


     public function editenfermera()
    {   $id=auth()->user()->id;
        $enfermera=Enfermera::enfermera()->findOrFail($id);
        $specialties = Especialidad::all();
        $specialty_ids = $enfermera->specialties()->pluck('especialidad_id');
     return view('enfermera.perfil',compact('enfermera','specialties','specialty_ids'));
    }


    public function updateenfermera(Request $request, $id)
    {
          $roles=[
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'dni' => 'digits:8'];

        $validatedData = $request->validate($roles);

        $user=Enfermera::enfermera()->findOrFail($id);
        $data=$request->only('name','email','phone','address','dni');

        $password=$request->input('password');
            if ($password!=null){
                $data['password']=bcrypt($password);
            }
        $user->fill($data);
        $user->save();//UPDATE guardar cambios

        $user->specialties()->sync($request->input('specialties'));

        $notification='La informacion  se ha actualizado correctamente';
        return redirect('/perfil/enfermera')->with(compact('notification'));
        //return back()->with('notification', 'El medico se ha registrado correctamente');
    }

}
