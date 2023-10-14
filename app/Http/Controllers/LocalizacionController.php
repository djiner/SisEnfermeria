<?php

namespace App\Http\Controllers;

use App\Models\localizacion;
use Illuminate\Http\Request;

class LocalizacionController extends Controller
{

    public function index()
    {
        $localizaciones = Localizacion::all();
        return view('localizacion.index', compact('localizaciones'));
    }

    public function create()
    {
        return view('localizacion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'Latitud' => 'required|numeric',
            'Longitud' => 'required|numeric',
            'direccion' => 'required|max:200',
            'zona' => 'required|max:50',
            'numeroCasa' => 'nullable|max:10',
            'calle' => 'max:50',
        ]);

        // Formatear los valores de Latitud y Longitud para que tengan un formato adecuado
        $latitud = floatval(str_replace(',', '.', $request->input('Latitud')));
        $longitud = floatval(str_replace(',', '.', $request->input('Longitud')));

        $localizacion = new Localizacion();
        $localizacion->nombre = $request->input('nombre');
        $localizacion->Latitud = $request->input('Latitud');
        $localizacion->Longitud = $request->input('Longitud');
        $localizacion->direccion = $request->input('direccion');
        $localizacion->zona = $request->input('zona');
        $localizacion->numeroCasa = $request->input('numeroCasa');
        $localizacion->calle = $request->input('calle');

        $localizacion->save();

        return redirect()->route('localizacion.index')->with('success', 'Localización creada exitosamente');
    }

    public function show($id)
    {
        $localizacion = Localizacion::findOrFail($id);
        return view('localizacion.show', compact('localizacion'));
    }

    public function edit($id)
    {
        $localizacion = Localizacion::findOrFail($id);
        return view('localizacion.edit', compact('localizacion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'Latitud' => 'required|numeric',
            'Longitud' => 'required|numeric',
            'direccion' => 'required|max:200',
            'zona' => 'required|max:50',
            'numeroCasa' => 'nullable|max:10',
            'calle' => 'max:50',
        ]);

        $localizacion = Localizacion::findOrFail($id);
        $localizacion->nombre = $request->input('nombre');
        $localizacion->Latitud = $request->input('Latitud');
        $localizacion->Longitud = $request->input('Longitud');
        $localizacion->direccion = $request->input('direccion');
        $localizacion->zona = $request->input('zona');
        $localizacion->numeroCasa = $request->input('numeroCasa');
        $localizacion->calle = $request->input('calle');

        $localizacion->save();

        return redirect()->route('localizacion.index')->with('success', 'Localización actualizada exitosamente');
    }

    public function destroy($id)
    {
        $localizacion = Localizacion::findOrFail($id);
        $localizacion->delete();

        return redirect()->route('localizacion.index')->with('success', 'Localización eliminada exitosamente');
    }
}
