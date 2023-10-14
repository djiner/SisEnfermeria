@extends('layouts.panel')

@section('subtitle', 'Panel de control')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                @include('home.card')
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3>Enfermeras Registradas</h3>
                    <p></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3>Pacientes Registrados</h3>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 mb-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3>Proximas Citas</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3>Enfermera mas Activa</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 mb-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3>Localizacion</h3>
                    <div id="map" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 8
                });

                // Puedes agregar marcadores, polígonos, rutas, etc., en el mapa según tus necesidades.
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=TU_CLAVE_DE_API&callback=initMap" async defer></script>
        <div class="col-md-6 mb-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3>Calendario</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
