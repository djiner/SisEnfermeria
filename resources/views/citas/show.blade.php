@extends('layouts.panel')

@section('title', 'Detalle de Cita Médica')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-3 pt-md-6"></div>

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-12 mb-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Cita #{{ $cita->id }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            <strong>Fecha:</strong> {{ $cita->fecha }}
                        </li>
                        <li>
                            <strong>Hora:</strong> {{ $cita->hora_atencion }}
                        </li>

                        @if ($role == 'paciente' || $role == 'admin')
                        <li>
                            <strong>Enfermera:</strong> {{ $cita->enfermera->name }}
                        </li>
                        @endif

                        @if ($role == 'enfermera' || $role == 'admin')
                        <li>
                            <strong>Paciente:</strong> {{ $cita->paciente->name }}
                        </li>
                        @endif

                        <li>
                            <strong>Especialidad:</strong> {{ $cita->especialidad->name }}
                        </li>

                        <li>
                            <strong>Tipo de Consulta:</strong> {{ $cita->tipo_consulta }}
                        </li>
                        <li>
                            <strong>Estado:</strong>
                            @if ($cita->estado == 'Cancelada')
                            <span class="badge badge-danger">Cancelada</span>
                            @else
                            <span class="badge badge-success">{{ $cita->estado }}</span>
                            @endif
                        </li>
                    </ul>

                    @if ($cita->estado == 'Cancelada')
                    <div class="alert alert-warning">
                        <p>Detalles de la cancelación:</p>
                        <ul>
                            @if ($cita->cancellation)
                            <li>
                                <strong>Fecha de cancelación:</strong>
                                {{ $cita->cancellation->created_at }}
                            </li>
                            <li>
                                <strong>Cancelada por:</strong>
                                @if (auth()->id() == $cita->cancellation->cancelada_por_id)
                                Tú
                                @else
                                {{ $cita->cancellation->cancelada_por->name }}
                                @endif
                            </li>
                            <li>
                                <strong>Motivo de cancelación:</strong>
                                {{ $cita->cancellation->justificacion }}
                            </li>
                            @else
                            <li>Esta cita fue cancelada antes de su confirmación.</li>
                            @endif
                        </ul>
                    </div>
                    @endif

                    <a href="{{ route('citas.index') }}" class="btn btn-default">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
