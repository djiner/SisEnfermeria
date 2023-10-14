@extends('layouts.panel')


@section('content')
<div class="header bg-gradient-primary pb-6 pt-3 pt-md-6">
    <!-- Aquí puedes agregar contenido para el encabezado si es necesario -->
</div>

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col-xl-12 mb-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Especialidades</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url('/especialidades/create')}}" class="btn btn-sm btn-primary">Nueva Especialidad</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specialties as $especialidad)
                            <tr>
                                <th scope="row">
                                    {{ $especialidad->nombre }}
                                </th>
                                <td>
                                    {{ $especialidad->descripcion }}
                                </td>
                                <td>
                                    <form action="{{ url('/especialidades/'.$especialidad->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ url('/especialidades/'.$especialidad->id.'/edit') }}"
                                            class="btn btn-sm btn-primary">Editar</a>
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
