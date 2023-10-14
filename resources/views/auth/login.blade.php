@extends('layouts.form')

@section('title','login')

@section('content')
<div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="header-body text-center mb-2">
                  <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12">
                      <h1 class="text-black">Iniciar Session!</h1>
                    </div>
                  </div>
                </div>

              @if($errors->any())
              <div class="text-center text-muted mb-4">
                <small class="text-black">Ops se encontro un error.</small>
              </div>

              <div class="alert alert-danger" role="alert">
                  {{ $errors->first() }}
              </div>

              @else
              <div class="text-center text-muted mb-4">
                <small class="text-black">Ingresar tus datos para iniciar session</small>
              </div>
              @endif

              <form role="form" method="POST" action="{{ route('login') }}">
                 @csrf
                 <div class="form-group mb-3">
                    <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                  </div>
                  <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="NombreUsuario">
                    </div>
                  </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class= "input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" type="password" name="password" required autocomplete="current-password">

                  </div>
                </div>

                <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id=" customCheckLogin" type="checkbox"  id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' :'' }}>
                 <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">recordar session</span>
                  </label>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-3">Ingresar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{ route('password.request') }}" class="text-light">
                <small>¿olvidaste tu contraseña?</small>
                </a>
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('register') }}" class="text-light">
                <small>¿Aun no tienes cuenta?</small>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
