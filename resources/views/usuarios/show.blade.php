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
                    <h3 class="mb-0">Detalles del Usuario</h3>
                </div>
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Información del Usuario</h6>
                    <!-- Muestra aquí los campos de información del usuario -->
                    <div class="pl-lg-4">
                        <dl class="row">
                            <dt class="col-sm-4">Nombre:</dt>
                            <dd class="col-sm-8">{{ $usuario->name }}</dd>

                            <dt class="col-sm-4">Correo Electrónico:</dt>
                            <dd class="col-sm-8">{{ $usuario->email }}</dd>

                            <!-- Agrega más campos de usuario aquí -->

                        </dl>
                    </div>

                    <hr class="my-4">

                    <!-- Muestra aquí los campos de información de la persona -->
                    <h6 class="heading-small text-muted mb-4">Datos de la Persona</h6>
                    <div class="pl-lg-4">
                        <dl class="row">
                            <dt class="col-sm-4">Foto:</dt>
                            <dd class="col-sm-8">
                                <img src="{{ asset('storage/' . $usuario->foto) }}" alt="Foto de perfil" class="img-fluid">
                            </dd>

                            <dt class="col-sm-4">Nombres:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->nombres }}</dd>

                            <dt class="col-sm-4">Primer Apellido:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->primerApellido }}</dd>

                            <dt class="col-sm-4">Segundo Apellido:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->segundoApellido }}</dd>

                            <dt class="col-sm-4">CI:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->ci }}</dd>

                            <dt class="col-sm-4">Fecha de Nacimiento:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->fechaNacimiento }}</dd>

                            <dt class="col-sm-4">Dirección:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->direccion }}</dd>

                            <dt class="col-sm-4">Celular:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->celular }}</dd>

                            <dt class="col-sm-4">Sexo:</dt>
                            <dd class="col-sm-8">{{ $usuario->persona->sexo }}</dd>

                            <!-- Agrega más campos de persona aquí -->

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
