<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::paginate(10); // 10 registros por página
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'imagen' => 'required|image|mimes:jpeg,png,svg|max:1024',
            'nombres' => 'required|string|max:100|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'primer_Apellido' => 'required|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'segundo_Apellido' => 'nullable|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'ci' => 'required|string|max:15|regex:/^[0-9]+$/',
            'fecha_Nacimiento' => 'required|date',
            'direccion' => 'required|string|max:200',
            'celular' => 'required|string|max:12|regex:/^[0-9]+$/',
            'sexo' => 'required|string|max:1|in:M,F', // Ajusta los valores permitidos según tus necesidades
            'role' => 'required|in:superadmin,admin,enfermera,paciente',
        ]);


        // Para crear un nuevo usuario y una nueva persona:
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save(); // Guarda el usuario primero

        $persona = new Persona([
            'nombres' => $request->nombres,
            'primer_Apellido' => $request->primer_Apellido,
            'segundo_Apellido' => $request->segundo_Apellido,
            'ci' => $request->ci,
            'fecha_Nacimiento' => $request->fecha_Nacimiento,
            'direccion' => $request->direccion,
            'celular' => $request->celular,
            'sexo' => $request->sexo,
        ]);

        // Verifica si se proporcionó una imagen
        if ($request->hasFile('imagen')) {
            $rutaGuardarImg = 'img/brand';
            $imagenPerfil = date('YmdHis'). "." . $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move($rutaGuardarImg, $imagenPerfil);

            // Asigna el nombre único de la imagen a la persona
            $persona->imagen = $imagenPerfil;
        }
        // Asocia la persona al usuario y guárdala
        $user->persona()->save($persona);

        // Asigna el rol al usuario en función del formulario
                if ($request->role === 'superadmin') {
                    $user->assignRole('superadmin');
                } elseif ($request->role === 'admin') {
                    $user->assignRole('admin');
                } elseif ($request->role === 'enfermera') {
                    $user->assignRole('enfermera');
                } else {
                    $user->assignRole('paciente');
                }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id); // Asegúrate de que el usuario exista
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::with('persona')->findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
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
        ]);

        $persona = $usuario->persona; // Obtener la persona relacionada

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'img/brand';
            $imagenPerfil = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenPerfil);
            $persona->imagen = $imagenPerfil;
        } else {
            unset($persona->imagen);
        }

        // Actualiza los campos de la persona
        $persona->nombres = $request->nombres;
        $persona->primer_Apellido = $request->primer_Apellido;
        $persona->segundo_Apellido = $request->segundo_Apellido;
        $persona->ci = $request->ci;
        $persona->fecha_Nacimiento = $request->fecha_Nacimiento;
        $persona->direccion = $request->direccion;
        $persona->celular = $request->celular;
        $persona->sexo = $request->sexo;

        // Guarda los cambios en el usuario (modelo principal)
        $usuario->save();
        // Guarda los cambios en la persona (modelo relacionado)
        $persona->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->persona && $usuario->persona->imagen) {
            $rutaImagen = 'img/brand/' . $usuario->persona->imagen;
            if (Storage::disk('public')->exists($rutaImagen)) {
                Storage::disk('public')->delete($rutaImagen);
            }
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito');
    }
}
