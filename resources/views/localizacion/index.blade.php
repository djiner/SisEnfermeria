@extends('layouts.panel')

@section('subtitle', 'administrador')

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
                            <h3 class="mb-0 btnagregar">Usuarios <a href="{{ url('localizacion/create') }}"
                                    class="btn btn-sm btn-success"><i class="fas fa-plus-circle "></i> Agregar</a></h3>
                            <h1>Listado de Localizaciones</h1>
                            <a href="{{ route('localizacion.create') }}" class="btn btn-success">Nueva Localización</a>

                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Latitud</th>
                                        <th>Longitud</th>
                                        <th>Dirección</th>
                                        <th>Zona</th>
                                        <th>Número de Casa</th>
                                        <th>Calle</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($localizaciones as $localizacion)
                                    <tr>
                                        <td>{{ $localizacion->nombre }}</td>
                                        <td>{{ $localizacion->Latitud }}</td>
                                        <td>{{ $localizacion->Longitud }}</td>
                                        <td>{{ $localizacion->direccion }}</td>
                                        <td>{{ $localizacion->zona }}</td>
                                        <td>{{ $localizacion->numeroCasa }}</td>
                                        <td>{{ $localizacion->calle }}</td>
                                        <td>
                                            <a href="{{ route('localizacion.show', $localizacion->id) }}"
                                                class="btn btn-primary">Ver</a>
                                            <a href="{{ route('localizacion.edit', $localizacion->id) }}"
                                                class="btn btn-warning">Editar</a>
                                            <form action="{{ route('localizacion.destroy', $localizacion->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta localización?')">Eliminar</button>
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
    </div>
</div>
@endsection
