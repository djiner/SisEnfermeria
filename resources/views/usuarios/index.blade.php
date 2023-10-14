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
                            <h3 class="mb-0">Listado de Usuarios</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-sm btn-primary">Crear Usuario</a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white"> <!-- Agrega una clase para establecer el fondo blanco -->
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

                    @if (count($usuarios) > 0)
                        <!-- Tabla de Usuarios -->
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
                                        <th>CI</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Dirección</th>
                                        <th>Celular</th>
                                        <th>Sexo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td><img src="{{ asset('img/brand/' . optional($usuario->persona)->imagen) }}" alt="Foto" width="50"></td>
                                            <td>{{ optional($usuario->persona)->nombres }}</td>
                                            <td>{{ optional($usuario->persona)->primer_Apellido }}</td>
                                            <td>{{ optional($usuario->persona)->segundo_Apellido }}</td>
                                            <td>{{ optional($usuario->persona)->ci }}</td>
                                            <td>{{ optional($usuario->persona)->fecha_Nacimiento }}</td>
                                            <td>{{ optional($usuario->persona)->direccion }}</td>
                                            <td>{{ optional($usuario->persona)->celular }}</td>
                                            <td>{{ optional($usuario->persona)->sexo }}</td>
                                            <td>
                                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $usuario->id }}">Eliminar</button>
                                            </td>
                                        </tr>

                                        <!-- Modal de Eliminación -->
                                        <div class="modal fade" id="deleteModal{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Usuario</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de eliminar este usuario?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $usuarios->links() }}
                    @else
                        <p>No hay usuarios registrados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
