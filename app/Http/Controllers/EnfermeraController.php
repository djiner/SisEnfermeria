<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermera;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EnfermeraController extends Controller
{
    public function index()
    {
        $enfermeras = Enfermera::with(['persona', 'user'])->whereNull('deleted_at')->paginate(10);
        return view('enfermeras.index', compact('enfermeras'));
    }

    public function create()
    {
        return view('enfermeras.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'imagen' => 'required|image|mimes:jpeg,png,svg|max:1024',
            'nombres' => 'required|string|max:100|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'primer_Apellido' => 'required|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'segundo_Apellido' => 'nullable|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'ci' => 'required|string|max:15|regex:/^[0-9]+$/',
            'fecha_Nacimiento' => 'required|date',
            'direccion' => 'required|string|max:200|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'celular' => 'required|string|max:12|regex:/^[0-9]+$/',
            'sexo' => 'required|string|max:1|in:M,F', // Ajusta los valores permitidos según tus necesidades
            'role' => 'required|in:superadmin,admin,enfermera,paciente',
            'especialidad' => 'required|string|max:50|regex:/^[A-Za-zá-úÁ-Ú\s\-\'\(\)\/\,]+',
            'curriculoVitae' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'carga_Horaria' => 'required|string|max:255',

        ]);


        // Crear el usuario
        $user = new User([
            'name' => $request->input('nombres'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'enfermera',
        ]);

        $user->save();

        $persona = new Persona([
            'nombres' => $request->input('nombres'),
            'primer_Apellido' => $request->input('primer_Apellido'),
            'segundo_Apellido' => $request->input('segundo_Apellido'),
            'ci' => $request->input('ci'),
            'fecha_Nacimiento' => $request->input('fecha_Nacimiento'),
            'sexo' => $request->input('sexo'),
            'direccion' => $request->input('direccion'),
            'celular' => $request->input('celular'),
        ]);

        if ($request->hasFile('imagen')) {
            $rutaGuardarImg = 'img/brand';
            $imagenPerfil = date('YmdHis') . "." . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move($rutaGuardarImg, $imagenPerfil);
            $persona->imagen = $imagenPerfil;
        }

        $persona->user()->associate($user); // Asocia la persona con el usuario
        $persona->save();

        $cargaHoraria = $request->input('carga_Horaria'); // Asigna la carga horaria antes de crear $enfermera

        $enfermera = new Enfermera([
            'especialidad' => $request->input('especialidad'),
            'curriculoVitae' => null,
            'carga_Horaria' => $cargaHoraria, // Asigna carga_Horaria aquí
        ]);

        if ($request->hasFile('curriculoVitae')) {
            $cvFile = $request->file('curriculoVitae');
            $cvFileName = time() . '_' . $cvFile->getClientOriginalName();
            $cvFile->move(public_path('cv_files'), $cvFileName);
            $enfermera->curriculoVitae = 'cv_files/' . $cvFileName;
        }

        $persona->enfermera()->save($enfermera); // Asocia la persona con la enfermera

        return redirect()->route('enfermeras.index')->with('success', 'Enfermera creada con éxito.');

    }


    public function show($id)
    {
        $enfermera = Enfermera::findOrFail($id);
        return view('enfermeras.show', compact('enfermera'));
    }

    public function edit($id)
    {
        $enfermera = Enfermera::findOrFail($id);
        return view('enfermeras.edit', compact('enfermera'));
    }

    public function update(Request $request, $id)
    {
        $enfermera = Enfermera::findOrFail($id);
        $persona = $enfermera->persona;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
            'nombres' => 'required|string|max:100|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'primer_Apellido' => 'required|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'segundo_Apellido' => 'nullable|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'ci' => 'required|string|max:15|regex:/^[0-9]+$/',
            'fecha_Nacimiento' => 'required|date',
            'direccion' => 'required|string|max:200|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'celular' => 'required|string|max:12|regex:/^[0-9]+$/',
            'sexo' => 'required|string|max:1|in:M,F',
            'especialidad' => 'required|string|max:50|regex:/^[A-Za-zá-úÁ-Ú\s\-\'\(\)\/\,]+',
            'curriculoVitae' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'carga_Horaria' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('enfermeras.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Actualizar el usuario
        $user = User::findOrFail($enfermera->admin_id);
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        // Actualizar los campos de la persona y enfermera
        $persona->nombres = $request->input('nombres');
        $persona->primer_Apellido = $request->input('primer_Apellido');
        $persona->segundo_Apellido = $request->input('segundo_Apellido');
        $persona->ci = $request->input('ci');
        $persona->fecha_Nacimiento = $request->input('fecha_Nacimiento');
        $persona->sexo = $request->input('sexo');
        $persona->direccion = $request->input('direccion');
        $persona->celular = $request->input('celular');

        if ($request->hasFile('imagen')) {
            $rutaGuardarImg = 'img/brand';
            $imagenPerfil = date('YmdHis'). "." . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move($rutaGuardarImg, $imagenPerfil);
            $persona->imagen = $imagenPerfil;
        }

        $persona->save();

        $enfermera->especialidad = $request->input('especialidad');
        $enfermera->carga_Horaria = $request->input('carga_Horaria');

        if ($request->hasFile('curriculoVitae')) {
            $cvFile = $request->file('curriculoVitae');
            $cvFileName = time() . '_' . $cvFile->getClientOriginalName();
            $cvFile->move(public_path('cv_files'), $cvFileName);
            $enfermera->curriculoVitae = 'cv_files/' . $cvFileName;
        }

        return redirect()->route('enfermeras.index')->with('success', 'Enfermera actualizada con éxito.');
    }

    public function destroy($id)
    {
        $enfermera = Enfermera::findOrFail($id);

        if ($enfermera->persona->imagen) {
            Storage::delete($enfermera->persona->imagen);
        }

        if ($enfermera->curriculoVitae) {
            Storage::delete($enfermera->curriculoVitae);
        }

        $enfermera->delete();

        return redirect()->route('enfermeras.index')->with('success', 'Enfermera eliminada con éxito.');
    }
}

