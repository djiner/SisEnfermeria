@extends('layouts.panel')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

@section('content')
<div class="container">
    <h1>Detalles de la Ubicación</h1>

    <div>
        <strong>Nombre:</strong> {{ $localizacion->nombre }}
    </div>
    <div>
        <strong>Latitud:</strong> {{ $localizacion->Latitud }}
    </div>
    <div>
        <strong>Longitud:</strong> {{ $localizacion->Longitud }}
    </div>

    <!-- Contenedor para el mapa -->
    <div id="map" style="height: 400px;"></div>

    <a href="{{ route('localizacion.index') }}" class="btn btn-primary">Volver</a>
</div>

<script>
    // Recuperar latitud y longitud de la ubicación
    var latitud = {{ $localizacion->Latitud }};
    var longitud = {{ $localizacion->Longitud }};

    // Crear un mapa y agregar un marcador en la ubicación
    var map = L.map('map').setView([latitud, longitud], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([latitud, longitud]).addTo(map)
        .bindPopup('{{ $localizacion->nombre }}')
        .openPopup();
</script>

@endsection
