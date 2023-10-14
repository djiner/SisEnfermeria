@extends('layouts.panel')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-3 pt-md-6">
    <!-- Puedes agregar contenido adicional al encabezado si es necesario -->
</div>

<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-xl-6 mb-5">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Editar Usuario</h3>
                    <div class="col text-right">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary">Regresar</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Error:</strong> Por favor corrige los errores en el formulario.
                    </div>
                    @endif
                    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Usamos el método PUT para actualizar -->
                        <h6 class="heading-small text-muted mb-4">Información del Usuario</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Nombre</label>
                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre" value="{{ old('name', $usuario->name) }}" required autofocus>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">Email</label>
                                    <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email', $usuario->email) }}" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Selector de archivo y visualización de la imagen -->
                        <div class="flex items-center justify-center">
                            <input type="file" id="imagen" name="imagen" accept="image/*" style="display: none;" onchange="mostrarImagenSeleccionada()">
                            <label for="imagen" class="cursor-pointer">
                                Seleccionar Imagen
                            </label>
                            <img id="imagenSeleccionada" src="{{ asset('img/brand/' . $usuario->persona->imagen) }}" alt="Imagen seleccionada" style="max-width: 70%; max-height: 100px;">
                        </div>

                        <script>
                            function mostrarImagenSeleccionada() {
                                const inputImagen = document.getElementById('imagen');
                                const imagenSeleccionada = document.getElementById('imagenSeleccionada');

                                if (inputImagen.files && inputImagen.files[0]) {
                                    const reader = new FileReader();

                                    reader.onload = function (e) {
                                        imagenSeleccionada.src = e.target.result;
                                    };

                                    reader.readAsDataURL(inputImagen.files[0]);
                                }
                            }
                        </script>

                        <hr class="my-4">
                        <h6 class="heading-small text-muted mb-4">Información Personal</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('nombres') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nombres">Nombres</label>
                                    <input type="text" name="nombres" id="input-nombres" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" placeholder="Nombres" value="{{ old('nombres', $usuario->persona->nombres) }}" required>
                                    @if ($errors->has('nombres'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('primer_Apellido') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-primerApellido">Primer Apellido</label>
                                    <input type="text" name="primer_Apellido" id="input-primerApellido" class="form-control{{ $errors->has('primer_Apellido') ? ' is-invalid' : '' }}" placeholder="Primer Apellido" value="{{ old('primer_Apellido', $usuario->persona->primer_Apellido) }}" required>
                                    @if ($errors->has('primer_Apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('primer_Apellido') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('segundo_Apellido') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-segundoApellido">Segundo Apellido</label>
                                    <input type="text" name="segundo_Apellido" id="input-segundoApellido" class="form-control{{ $errors->has('segundo_Apellido') ? ' is-invalid' : '' }}" placeholder="Segundo Apellido" value="{{ old('segundo_Apellido', $usuario->persona->segundo_Apellido) }}">
                                    @if ($errors->has('segundo_Apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('segundo_Apellido') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('ci') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ci">Cédula de Identidad</label>
                                    <input type="text" name="ci" id="input-ci" class="form-control{{ $errors->has('ci') ? ' is-invalid' : '' }}" placeholder="Cédula de Identidad" value="{{ old('ci', $usuario->persona->ci) }}" required>
                                    @if ($errors->has('ci'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('fecha_Nacimiento') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-fechaNacimiento">Fecha de Nacimiento (año-mes-día) </label>
                                    <input type="text" name="fecha_Nacimiento" id="input-fechaNacimiento" class="form-control{{ $errors->has('fecha_Nacimiento') ? ' is-invalid' : '' }}" value="{{ old('fecha_Nacimiento', $usuario->persona->fecha_Nacimiento) }}" required>
                                    @if ($errors->has('fecha_Nacimiento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_Nacimiento') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-direccion">Dirección</label>
                                    <input type="text" name="direccion" id="input-direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" placeholder="Dirección" value="{{ old('direccion', $usuario->persona->direccion) }}" required>
                                    @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-celular">Celular</label>
                                    <input type="text" name="celular" id="input-celular" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="Celular" value="{{ old('celular', $usuario->persona->celular) }}" required>
                                    @if ($errors->has('celular'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('celular') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('sexo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-sexo">Sexo</label>
                                    <select name="sexo" id="input-sexo" class="form-control{{ $errors->has('sexo') ? ' is-invalid' : '' }}" required>
                                        <option value="M" {{ old('sexo', $usuario->persona->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo', $usuario->persona->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                    @if ($errors->has('sexo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sexo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Agrega más campos de información personal aquí -->

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">Actualizar Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
