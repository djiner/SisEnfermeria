@extends('layouts.panel')

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
              <h3 class="mb-0">Nueva Especialidades</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/especialidades')}}" class="btn btn-sm btn-success">
                <i class="fas fa-chevron-left"></i>
                Regresar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
            @foreach ($errors->all() as $error )
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Por Favor!</strong> {{ $error}}
                </div>
            @endforeach
            @endif

            <form action="{{ url('/especialidades') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre de la Especialidad</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Crear especialidad</button>
            </form>
        </div>
    </div>

@endsection
