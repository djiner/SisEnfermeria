<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;


class EspecialidadController extends Controller
{
    public function index()
    {
        $specialties = Especialidad::paginate(10);
        return view('especialidades.index', compact('specialties'));
    }

    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {
         // Definir reglas de validación
    $rules = [
        'nombre' => 'required|min:3|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
        'descripcion' => 'required|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
    ];

    // Mensajes de error personalizados
    $messages = [
        'nombre.required' => 'El nombre de la especialidad es obligatorio.',
        'nombre.min' => 'El nombre de la especialidad debe tener más de 3 caracteres.',
        'regex' => 'El campo :attribute contiene caracteres no permitidos.',
        'descripcion.required' => 'La descripción de la especialidad es obligatoria.',
    ];

    // Validar los datos del formulario
    $validatedData = $request->validate($rules, $messages);

    // Crear una nueva instancia de Especialidad y asignar valores desde los datos validados
    $especialidad = new Especialidad;
    $especialidad->nombre = $validatedData['nombre'];
    $especialidad->descripcion = $validatedData['descripcion'];
    $especialidad->save();

    // Redirigir a la página de índice de especialidades con un mensaje de éxito
    return redirect()->route('especialidades.index')->with('success', 'Especialidad creada correctamente');
    }

    public function show($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.show', compact('especialidad'));
    }

    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, $id)
    {
         // Modificar las reglas de validación para permitir letras, números, espacios y caracteres especiales
    $rules = [
        'nombre' => 'required|min:3|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
        'descripcion' => 'required|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
    ];

    // Mensajes de error personalizados
    $messages = [
        'nombre.required' => 'El nombre de la especialidad es obligatorio.',
        'nombre.min' => 'El nombre de la especialidad debe tener al menos 3 caracteres.',
        'nombre.regex' => 'El nombre de la especialidad contiene caracteres no permitidos.',
        'descripcion.required' => 'La descripción de la especialidad es obligatoria.',
        'descripcion.regex' => 'La descripción de la especialidad contiene caracteres no permitidos.',
    ];

    // Validar los datos del formulario
    $validatedData = $request->validate($rules, $messages);

    // Buscar la especialidad por su ID
    $especialidad = Especialidad::findOrFail($id);

    // Actualizar los datos de la especialidad con los datos validados
    $especialidad->update($validatedData);

    // Redirigir a la página de índice de especialidades con un mensaje de éxito
    return redirect()->route('especialidades.index')->with('success', 'Especialidad actualizada correctamente');
    }

    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();

        return redirect()->route('especialidades.index')->with('success', 'Especialidad eliminada correctamente');
    }
}
