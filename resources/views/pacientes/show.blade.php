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
                            <h3 class="mb-0">Detalles del Paciente</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('pacientes.index') }}" class="btn btn-sm btn-primary">Regresar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h1>{{ $paciente->nombres }} {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }}</h1>
                    <p>CI: {{ $paciente->ci }}</p>
                    <p>Alergias: {{ $paciente->alergias }}</p>
                    <p>Enfermedad de Base: {{ $paciente->enfermedadDebase }}</p>
                    <p>Medicamentos: {{ $paciente->medicamentos }}</p>
                    <!-- Otros detalles del paciente -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
