@extends('layouts.panel')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

@section('content')
<h1>Crear Nueva Localización</h1>
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

<div id="map" style="height: 500px;"></div>

<form action="{{ route('localizacion.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <!-- Agrega campos para latitud y longitud -->
    <div class="form-group">
        <label for="Latitud">Latitud:</label>
        <input type="text" class="form-control" id="Latitud" name="Latitud" required>
    </div>
    <div class="form-group">
        <label for="Longitud">Longitud:</label>
        <input type="text" class="form-control" id="Longitud" name="Longitud" required>
    </div>
    <!-- Otros campos del formulario -->
    <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" class="form-control" id="direccion" name="direccion" required>
    </div>
    <div class="form-group">
        <label for="zona">Zona:</label>
        <input type="text" class="form-control" id="zona" name="zona" required>
    </div>
    <div class="form-group">
        <label for="numeroCasa">Número de Casa:</label>
        <input type="text" class="form-control" id="numeroCasa" name="numeroCasa">
    </div>
    <div class="form-group">
        <label for="calle">Calle:</label>
        <input type="text" class="form-control" id="calle" name="calle">
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

<!-- Script para inicializar el mapa -->
<script>
    var map = L.map('map').setView([-17.3939, -66.1571], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Agregar un marcador al hacer clic en el mapa
    var marker;
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        // Actualizar los campos de latitud y longitud en el formulario
        document.getElementById('Latitud').value = e.latlng.lat;
        document.getElementById('Longitud').value = e.latlng.lng;
    });
</script>
@endsection
