<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Persona;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nombres' => 'required|string|max:100|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'primer_Apellido' => 'required|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'segundo_Apellido' => 'nullable|string|max:80|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'ci' => 'required|string|max:15|regex:/^[0-9]+$/',
            'fecha_Nacimiento' => 'required|date',
            'direccion' => 'required|string|max:200|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'celular' => 'required|string|max:12|regex:/^[0-9]+$/',
            'sexo' => 'required|string|max:1|in:M,F',

            // Datos de paciente
            'alergias' => 'nullable|string|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'enfermedad_De_Base' => 'nullable|string|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
            'medicamentos' => 'nullable|string|regex:/^(?!.*(\S)\1)[A-Za-z0-9\s\-\'\(\)\/\,]+$/',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pacientes.create')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $input['nombres'],
                'email' => $input['email'],
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
                'password' => Hash::make($input['password']),
            ]);

            $persona = new Persona([
                'nombres' => $input['nombres'],
                'primer_Apellido' => $input['primer_Apellido'],
                'segundo_Apellido' => $input['segundo_Apellido'],
                'ci' => $input['ci'],
                'fecha_Nacimiento' => $input['fecha_Nacimiento'],
                'sexo' => $input['sexo'],
                'direccion' => $input['direccion'],
                'celular' => $input['celular'],
            ]);

            $persona->user()->associate($user);
            $persona->save();

            $paciente = new Paciente([
                'alergias' => $input['alergias'],
                'enfermedad_De_Base' => $input['enfermedad_De_Base'],
                'medicamentos' => $input['medicamentos'],
            ]);

            $persona->paciente()->save($paciente);

            DB::commit();
            // Enviar correo de verificación de correo electrónico
            if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
                $user->sendEmailVerificationNotification();
            }


            return redirect()->route('pacientes.index')->with('success', 'Paciente creado con éxito.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pacientes.create')->with('error', 'Error al crear el paciente.');
        }
    }
}
