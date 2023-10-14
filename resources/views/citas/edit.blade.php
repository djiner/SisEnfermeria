@extends('layouts.panel')

@section('content')
<div class="container">
    <h1>Editar Cita Médica</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error:</strong> Por favor, corrige los siguientes errores.
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('citas.update', $cita) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $cita->descripcion }}" required>
        </div>
        <div class="form-group">
            <label for="paciente">Paciente:</label>
            <input type="text" class="form-control" id="paciente" name="paciente" value="{{ $cita->paciente }}" required>
        </div>
        <div class="form-group">
            <label for="especialidad">Especialidad:</label>
            <input type="text" class="form-control" id="especialidad" name="especialidad" value="{{ $cita->especialidad }}" required>
        </div>
        <div class="form-group">
            <label for="enfermera">Enfermera:</label>
            <input type="text" class="form-control" id="enfermera" name="enfermera" value="{{ $cita->enfermera }}" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $cita->fecha }}" required>
        </div>
        <div class="form-group">
            <label for="hora_atencion">Hora:</label>
            <input type="time" class="form-control" id="hora_atencion" name="hora_atencion" value="{{ $cita->hora_atencion }}" required>
        </div>
        <div class="form-group">
            <label for="tipo_consulta">Tipo de Consulta:</label>
            <input type="text" class="form-control" id="tipo_consulta" name="tipo_consulta" value="{{ $cita->tipo_consulta }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Cita</button>
    </form>
    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
