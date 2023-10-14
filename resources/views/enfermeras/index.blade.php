@extends('layouts.panel')

@section('content')
<div class="header bg-gradient-primary pb-6 pt-3 pt-md-6">
    <!-- Puedes agregar contenido adicional al encabezado si es necesario -->
</div>

<div class="container-fluid mt--7">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-12 mb-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Listado de Enfermeras</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('enfermeras.create') }}" class="btn btn-sm btn-primary">Crear Enfermera</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white">
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

                    @if (count($enfermeras) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Foto</th>
                                        <th>Nombres</th>
                                        <th>Primer Apellido</th>
                                        <th>Segundo Apellido</th>
                                        <th>Cédula de Identidad</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Dirección</th>
                                        <th>Celular</th>
                                        <th>Sexo</th>
                                        <th>Especialidad</th>
                                        <th>Carga Horaria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enfermeras as $enfermera)
                                        <tr>
                                            <td>{{ optional($enfermera->persona)->user->name }}</td>
                                            <td>{{ optional($enfermera->persona)->user->email }}</td>
                                            <td><img src="{{ asset('img/brand/' . optional($enfermera->persona)->imagen) }}" alt="Foto" width="50"></td>
                                            <td>{{ optional($enfermera->persona)->nombres }}</td>
                                            <td>{{ optional($enfermera->persona)->primer_Apellido }}</td>
                                            <td>{{ optional($enfermera->persona)->segundo_Apellido }}</td>
                                            <td>{{ optional($enfermera->persona)->ci }}</td>
                                            <td>{{ optional($enfermera->persona)->fecha_Nacimiento }}</td>
                                            <td>{{ optional($enfermera->persona)->direccion }}</td>
                                            <td>{{ optional($enfermera->persona)->celular }}</td>
                                            <td>{{ optional($enfermera->persona)->sexo }}</td>

                                            <td>{{ optional($enfermera)->especialidad }}</td>
                                            <td>{{ optional($enfermera)->carga_Horaria }}</td>
                                            <td>
                                                <a href="{{ route('enfermeras.edit', $enfermera->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $enfermera->id }}">Eliminar</button>
                                            </td>
                                        </tr>
                                        <!-- Modal de eliminación lógica -->
                                        <div class="modal fade" id="deleteModal{{ $enfermera->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Enfermera</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar a esta enfermera?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <form method="POST" action="{{ route('enfermeras.destroy', $enfermera->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $enfermeras->links() }}
                    @else
                        <p>No hay enfermeras registradas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
