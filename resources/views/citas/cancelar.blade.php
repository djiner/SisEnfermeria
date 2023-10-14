@extends('layouts.panel')

@section('subtitle', 'Cancelar cita')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-3 pt-md-6">
</div>

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-12 mb-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Cancelar cita</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="margin: 20px;">
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif

                    @if ($role == 'paciente')
                        <p>
                            Estás a punto de cancelar tu cita reservada con el médico
                            {{ $cita->enfermera->name }}
                            (especialidad {{ $cita->especialidad->name }})
                            para el día {{ $cita->horario_date }}:
                        </p>
                    @elseif ($role == 'enfermera')
                        <p>
                            Estás a punto de cancelar tu cita con el paciente
                            {{ $cita->paciente->name }}
                            (especialidad {{ $cita->especialidad->name }})
                            para el día {{ $cita->horario_date }}
                            (hora {{ $cita->horario_time_12 }}):
                        </p>
                    @else
                        <p>
                            Estás a punto de cancelar la cita reservada
                            por el paciente {{ $cita->paciente->name }}
                            para ser atendido por el médico {{ $cita->enfermera->name }}
                            (especialidad {{ $cita->especialidad->name }})
                            el día {{ $cita->horario_date }}
                            (hora {{ $cita->horario_time_12 }}):
                        </p>
                    @endif

                    <form action="{{ url('/citas/'.$cita->id.'/cancelar') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="justification">Por favor cuéntanos el motivo de la cancelación:</label>
                            <textarea required id="justification" name="justification" rows="3"
                                class="form-control"></textarea>
                        </div>

                        <button class="btn btn-danger" type="submit">Cancelar cita</button>
                        <a href="{{ url('/citas') }}" class="btn btn-default">
                            Volver al listado de citas sin cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
