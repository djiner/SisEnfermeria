@extends('layouts.form')

@section('title', 'Registrarse')

@section('content')
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center mb-4">
                        <h1 class="text-black">
                            <i class="fas fa-user-plus"></i> Registrarse
                        </h1>
                        <p class="text-muted">Ingresa tus datos para crear una cuenta</p>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Datos de Usuario -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Usuario
                            </label>
                            <input placeholder="Usuario" id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input placeholder="Email" id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Contraseña
                            </label>
                            <input placeholder="Contraseña" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                required autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">
                                <i class="fas fa-lock"></i> Confirmar Contraseña
                            </label>
                            <input placeholder="Confirmar Contraseña" id="password-confirm" type="password"
                                class="form-control" name="password_confirmation" required
                                autocomplete="new-password">
                        </div>
                        <!-- Datos de Persona -->
                        <div class="mb-3">
                            <label for="nombres" class="form-label">
                                <i class="fas fa-user"></i> Nombres
                            </label>
                            <input placeholder="Nombres" id="nombres" type="text"
                                class="form-control @error('nombres') is-invalid @enderror" name="nombres"
                                value="{{ old('nombres') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="primer_Apellido" class="form-label">
                                <i class="fas fa-user"></i> Primer Apellido
                            </label>
                            <input placeholder="Primer Apellido" id="primer_Apellido" type="text"
                                class="form-control @error('primer_Apellido') is-invalid @enderror"
                                name="primer_Apellido" value="{{ old('primer_Apellido') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="segundoApellido" class="form-label">
                                <i class="fas fa-user"></i> Segundo Apellido
                            </label>
                            <input placeholder="Segundo Apellido" id="segundo_Apellido" type="text"
                                class="form-control" name="segundo_Apellido"
                                value="{{ old('segundo_Apellido') }}">
                        </div>
                        <div class="mb-3">
                            <label for="ci" class="form-label">
                                <i class="fas fa-id-card"></i> CI
                            </label>
                            <input placeholder="CI" id="ci" type="text"
                                class="form-control @error('ci') is-invalid @enderror" name="ci"
                                value="{{ old('ci') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_Nacimiento" class="form-label">
                                <i class="fas fa-calendar"></i> Fecha de Nacimiento
                            </label>
                            <input placeholder="Fecha de Nacimiento" id="fecha_Nacimiento" type="date"
                                class="form-control @error('fecha_Nacimiento') is-invalid @enderror"
                                name="fecha_Nacimiento" value="{{ old('fecha_Nacimiento') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">
                                <i class="fas fa-map-marker"></i> Dirección
                            </label>
                            <input placeholder="Dirección" id="direccion" type="text"
                                class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                value="{{ old('direccion') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="celular" class="form-label">
                                <i class="fas fa-phone"></i> Celular
                            </label>
                            <input placeholder="Celular" id="celular" type="text"
                                class="form-control @error('celular') is-invalid @enderror" name="celular"
                                value="{{ old('celular') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="sexo" class="form-label">
                                <i class="fas fa-venus-mars"></i> Sexo
                            </label>
                            <select id="sexo" class="form-control @error('sexo') is-invalid @enderror" name="sexo" required>
                                <option value="" disabled selected>Sexo</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <!-- Datos de Paciente -->
                        <div class="mb-3">
                            <label for="alergias" class="form-label">
                                <i class="fas fa-allergies"></i> Alergias
                            </label>
                            <input placeholder="Alergias" id="alergias" type="text"
                                class="form-control" name="alergias" value="{{ old('alergias') }}">
                        </div>
                        <div class="mb-3">
                            <label for="enfermedadDeBase" class="form-label">
                                <i class="fas fa-notes-medical"></i> Enfermedad de Base
                            </label>
                            <input placeholder="Enfermedad de Base" id="enfermedadDeBase" type="text"
                                class="form-control" name="enfermedadDeBase" value="{{ old('enfermedadDeBase') }}">
                        </div>
                        <div class="mb-3">
                            <label for="medicamentos" class="form-label">
                                <i class="fas fa-pills"></i> Medicamentos
                            </label>
                            <input placeholder="Medicamentos" id="medicamentos" type="text"
                                class="form-control" name="medicamentos" value="{{ old('medicamentos') }}">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">
                                <i class="fas fa-user-plus"></i> Registrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <a href="{{ route('password.request') }}" class="text-light">
                        <small>¿Olvidaste tu contraseña?</small>
                    </a>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('login') }}" class="text-light">
                        <small>¿Ya tienes una Cuenta?</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
