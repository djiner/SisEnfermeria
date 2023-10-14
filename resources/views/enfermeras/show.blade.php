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
                    <h3 class="mb-0">Detalles de Enfermera</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('enfermeras.index') }}" class="btn btn-sm btn-primary">Regresar</a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <img src="{{ $enfermera->imagen_url }}" alt="Imagen de la enfermera" style="max-width: 70%; max-height: 100px;">
                    </div>
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <p>{{ $enfermera->nombres }}</p>
                    </div>
                    <div class="form-group">
                        <label for="primer_Apellido">Primer Apellido:</label>
                        <p>{{ $enfermera->primer_Apellido }}</p>
                    </div>
                    <div class="form-group">
                        <label for="segundo_Apellido">Segundo Apellido:</label>
                        <p>{{ $enfermera->segundo_Apellido }}</p>
                    </div>
                    <div class="form-group">
                        <label for="ci">Cédula de Identidad:</label>
                        <p>{{ $enfermera->ci }}</p>
                    </div>
                    <div class="form-group">
                        <label for="fecha_Nacimiento">Fecha de Nacimiento:</label>
                        <p>{{ $enfermera->fecha_Nacimiento }}</p>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <p>{{ $enfermera->direccion }}</p>
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <p>{{ $enfermera->celular }}</p>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <p>{{ $enfermera->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p>
                    </div>
                    <!-- Agrega más campos según tus necesidades -->
                    <div class="form-group">
                        <label for="especialidad">Especialidad:</label>
                        <p>{{ $enfermera->especialidad }}</p>
                    </div>
                    <div class="form-group">
                        <label for="horario_Trabajo">Horario de Trabajo:</label>
                        <p>{{ $enfermera->horario_Trabajo }}</p>
                    </div>
                    <div class="form-group">
                        <label for="curriculoVitae">Currículum Vitae:</label>
                        <a href="{{ $enfermera->curriculoVitae_url }}" target="_blank">Ver Currículum Vitae</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
