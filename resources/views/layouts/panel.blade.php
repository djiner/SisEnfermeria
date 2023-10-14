<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="elmer velasquez">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/brand/favicon.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <!-- CSS Files -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.11.5/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}">
  @yield('styles')
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <div class="navbar-brand m-0 d-flex align-items-center justify-content-center" target="_blank" style="height: 100px; width: 200px; ">
        <img src="{{ asset('img/brand/blue.png') }}" class="navbar-brand-img" alt="..." style="max-height: 200%; max-width: 500%; ">
      </div>

      <!-- User -->
      <ul class="nav align-items-center d-md-none">
          @include('includes.panel.userOptions')
      </ul>


      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ url('/') }}">
                <img src="{{ asset('img/brand/logo.png') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        @include('includes.panel.menu')
      </div>
    </div>
  </nav>


  <!-- Main content -->

  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="javascript:void(0)">@yield('subtitle') </a>

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
        @include('includes.panel.userOptions')
        </ul>
      </div>
    </nav>
    <!-- Header -->

    <!-- Page content -->
  @yield('content')


<!-- Footer -->
    @include('includes.panel.footer')
  <!-- Argon Scripts -->
  <!-- Core -->
</div>
  <!-- Core Scripts -->
  <script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Optional Scripts -->
  <script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon Scripts -->
  <script src="{{ asset('js/argon-dashboard.min.js?v=1.1.2') }}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.11.5/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.11.5/locales/bootstrap-datepicker.es.min.js"></script> <!-- Opcional: Cargar localización en español -->
</body>

</html>
