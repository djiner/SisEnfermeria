@extends('layouts.panel')

@section('title', 'Citas')

@section('subtitle', 'Mis citas')

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
                            <h3 class="mb-0 btnagregar">Citas</h3>
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

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#confirmarcitas" role="tab"
                                aria-selected="true">
                                Próximas citas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pendientecitas" role="tab"
                                aria-selected="false">
                                Citas por confirmar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#historialcitas" role="tab"
                                aria-selected="false">
                                Historial de citas
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="confirmarcitas" role="tabpanel">
                            @include('citas.tables.confirmar')
                        </div>
                        <div class="tab-pane fade" id="pendientecitas" role="tabpanel">
                            @include('citas.tables.historial')
                        </div>
                        <div class="tab-pane fade" id="historialcitas" role="tabpanel">
                            @include('citas.tables.pendiente')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
