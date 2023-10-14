@extends('layouts.panel')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-3 pt-md-6">
    <!-- Contenido opcional para el encabezado -->
</div>

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-12 mb-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Editar Paciente</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('pacientes.index') }}" class="btn btn-sm btn-primary">Regresar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Formulario de edición de pacientes -->
                    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombres">Nombre</label>
                            <input type="text" name="nombres" id="nombres" class="form-control"
                                value="{{ $paciente->nombres }}" required>
                        </div>
                        <div class="form-group">
                            <label for="primer_apellido">Primer Apellido</label>
                            <input type="text" name="primer_apellido" id="primer_apellido" class="form-control"
                                value="{{ $paciente->primer_apellido }}" required>
                        </div>
                        <div class="form-group">
                            <label for="segundo_apellido">Segundo Apellido</label>
                            <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control"
                                value="{{ $paciente->segundo_apellido }}">
                        </div>
                        <div class="form-group">
                            <label for="ci">CI</label>
                            <input type="text" name="ci" id="ci" class="form-control" value="{{ $paciente->ci }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="alergias">Alergias</label>
                            <input type="text" name="alergias" id="alergias" class="form-control"
                                value="{{ $paciente->alergias }}">
                        </div>
                        <div class="form-group">
                            <label for="enfermedadDebase">Enfermedad de Base</label>
                            <input type="text" name="enfermedadDebase" id="enfermedadDebase" class="form-control"
                                value="{{ $paciente->enfermedadDebase }}">
                        </div>
                        <div class="form-group">
                            <label for="medicamentos">Medicamentos</label>
                            <input type="text" name="medicamentos" id="medicamentos" class="form-control"
                                value="{{ $paciente->medicamentos }}">
                        </div>
                        <!-- Otros campos del formulario -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
