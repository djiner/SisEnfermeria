@extends('layouts.panel')

@section('content')
<h1>Editar Localización</h1>
<a href="{{ route('localizacion.index') }}" class="btn btn-secondary">Volver</a>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('localizacion.update', $localizacion->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $localizacion->nombre }}" required>
    </div>
    <div class="form-group">
        <label for="Latitud">Latitud:</label>
        <input type="number" step="0.000001" class="form-control" id="Latitud" name="Latitud"
            value="{{ $localizacion->Latitud }}" required>
    </div>
    <div class="form-group">
        <label for="Longitud">Longitud:</label>
        <input type="number" step="0.000001" class="form-control" id="Longitud" name="Longitud"
            value="{{ $localizacion->Longitud }}" required>
    </div>
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion"
            value="{{ $localizacion->direccion }}" required>
    </div>
    <div class="form-group">
        <label for="zona">Zona:</label>
        <input type="text" class="form-control" id="zona" name="zona" value="{{ $localizacion->zona }}" required>
    </div>
    <div class="form-group">
        <label for="numeroCasa">Número de Casa:</label>
        <input type="text" class="form-control" id="numeroCasa" name="numeroCasa"
            value="{{ $localizacion->numeroCasa }}">
    </div>
    <div class="form-group">
        <label for="calle">Calle:</label>
        <input type="text" class="form-control" id="calle" name="calle" value="{{ $localizacion->calle }}">
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>
@endsection
