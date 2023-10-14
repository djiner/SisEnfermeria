@extends('layouts.panel')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-3 pt-md-6"></div>

<div class="container-fluid mt--7">
    <form action="{{ url('horario') }}" method="post">
        @csrf

        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 btnagregar">Gestionar Horario</h3>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('notification'))
                            <div class="alert alert-success" role="alert">
                                {{ session('notification') }}
                            </div>
                        @endif

                        @if (session('errors'))
                            <div class="alert alert-danger" role="alert">
                                Los cambios se han guardado pero tener en cuenta que:
                                <ul>
                                    @foreach (session('errors') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Día</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Turno Mañana</th>
                                    <th scope="col">Turno Tarde</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jornadasLaborales as $key => $jornadaLaboral)
                                <tr>
                                    <td>{{$dias[$key]}}</td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox" name="activas[]" value="{{$key}}" @if($jornadaLaboral->activa) checked @endif />
                                            <span class="custom-toggle-slider rounded-circle"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <select name="inicio_manana[]" class="form-control">
                                                    @for ($i=5; $i<=12;$i++)
                                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                                            @if($i.':00 AM' == $jornadaLaboral->inicio_manana || $i.':00 PM' == $jornadaLaboral->inicio_manana) selected @endif>
                                                            {{$i}}:00 @if($i==12) PM  @else AM @endif
                                                        </option>
                                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                                            @if($i.':30 AM' == $jornadaLaboral->inicio_manana || $i.':30 PM' == $jornadaLaboral->inicio_manana) selected @endif>
                                                            {{$i}}:30 @if($i==12) PM  @else AM @endif
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="fin_manana[]" class="form-control">
                                                    @for ($i=5; $i<=12;$i++)
                                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                                            @if($i.':00 AM' == $jornadaLaboral->fin_manana || $i.':00 AM' == $jornadaLaboral->fin_manana) selected @endif>
                                                            {{$i}}:00 @if($i==12) PM  @else AM @endif
                                                        </option>
                                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                                            @if($i.':30 AM' == $jornadaLaboral->fin_manana || $i.':30 PM' == $jornadaLaboral->fin_manana) selected @endif>
                                                            {{$i}}:30 @if($i==12) PM  @else AM @endif
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <select name="inicio_tarde[]" class="form-control">
                                                    @for ($i = 13; $i <= 20; $i++)
                                                        <option value="{{ $i }}:00"
                                                            @if($i.':00 PM' == $jornadaLaboral->inicio_tarde) selected @endif>
                                                            {{ $i }}:00 PM
                                                        </option>
                                                        <option value="{{ $i }}:30"
                                                            @if($i.':30 PM' == $jornadaLaboral->inicio_tarde) selected @endif>
                                                            {{ $i }}:30 PM
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="fin_tarde[]" class="form-control">
                                                    @for ($i = 13; $i <= 20; $i++)
                                                        <option value="{{ $i }}:00"
                                                            @if($i.':00 PM' == $jornadaLaboral->fin_tarde) selected @endif>
                                                            {{ $i }}:00 PM
                                                        </option>
                                                        <option value="{{ $i }}:30"
                                                            @if($i.':30 PM' == $jornadaLaboral->fin_tarde) selected @endif>
                                                            {{ $i }}:30 PM
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
