<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::paginate(10); // Cambia el número de registros por página según tus necesidades

        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la foto (opcional)
            'nombres' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:80',
            'segundo_apellido' => 'nullable|string|max:80',
            'ci' => 'required|string|max:15',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|in:M,F',
            'direccion' => 'nullable|string|max:200',
            'celular' => 'required|string|max:12',
            'alergias' => 'nullable|string|max:255', // Nuevo campo "alergias"
            'enfermedad_De_base' => 'nullable|string|max:255', // Nuevo campo "enfermedadDebase"
            'medicamentos' => 'nullable|string|max:255', // Nuevo campo "medicamentos"
        ]);

        // Manejo de la foto (si es necesario)
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('public/fotos'); // Guardar la foto en una carpeta pública
        } else {
            $foto = null; // No se proporcionó foto
        }

        Paciente::create([
            'foto' => $foto,
            'nombres' => $request->input('nombres'),
            'primer_apellido' => $request->input('primer_apellido'),
            'segundo_apellido' => $request->input('segundo_apellido'),
            'ci' => $request->input('ci'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $request->input('sexo'),
            'direccion' => $request->input('direccion'),
            'celular' => $request->input('celular'),
            'alergias' => $request->input('alergias'), // Nuevo campo "alergias"
            'enfermedad_De_base' => $request->input('enfermedadDebase'), // Nuevo campo "enfermedadDebase"
            'medicamentos' => $request->input('medicamentos'), // Nuevo campo "medicamentos"
        ]);

        return redirect('/pacientes')->with('success', 'Paciente creado exitosamente.');
    }

    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.show', compact('paciente'));
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la foto (opcional)
            'nombres' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:80',
            'segundo_apellido' => 'nullable|string|max:80',
            'ci' => 'required|string|max:15',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|in:M,F',
            'direccion' => 'nullable|string|max:200',
            'celular' => 'required|string|max:12',
            'alergias' => 'nullable|string|max:255', // Nuevo campo "alergias"
            'enfermedad_De_base' => 'nullable|string|max:255', // Nuevo campo "enfermedadDebase"
            'medicamentos' => 'nullable|string|max:255', // Nuevo campo "medicamentos"
        ]);

        $paciente = Paciente::findOrFail($id);

        // Actualización de la foto (si es necesario)
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('public/fotos'); // Guardar la foto en una carpeta pública
            $paciente->update(['foto' => $foto]);
        }

        $paciente->update([
            'nombres' => $request->input('nombres'),
            'primer_apellido' => $request->input('primer_apellido'),
            'segundo_apellido' => $request->input('segundo_apellido'),
            'ci' => $request->input('ci'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $request->input('sexo'),
            'direccion' => $request->input('direccion'),
            'celular' => $request->input('celular'),
            'alergias' => $request->input('alergias'), // Nuevo campo "alergias"
            'enfermedad_De_base' => $request->input('enfermedadDebase'), // Nuevo campo "enfermedadDebase"
            'medicamentos' => $request->input('medicamentos'), // Nuevo campo "medicamentos"
        ]);

        return redirect('/pacientes')->with('success', 'Paciente actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect('/pacientes')->with('success', 'Paciente eliminado exitosamente.');
    }

}
