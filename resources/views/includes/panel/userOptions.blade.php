
<li class="nav-item dropdown">
    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <div class="media align-items-center">
        <span class="avatar avatar-sm rounded-circle">
          <img alt="Image placeholder" src="{{ asset('img/theme/react.jpg') }}">
        </span>
        <div class="media-body ml-2 d-none d-lg-block">
          <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
        </div>
      </div>
    </a>

<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
      <h5 class="text-overflow m-0">Bienvenidos</h5>
    </div>
    <a href="#" class="dropdown-item">
      <i class="ni ni-single-02"></i>
      <span>Mi perfil</span>
    </a>
    <a href="#" class="dropdown-item">
      <i class="ni ni-settings-gear-65"></i>
      <span>Mis Citas</span>
    </a>
    <a href="#" class="dropdown-item">
      <i class="ni ni-calendar-grid-58"></i>
      <span>Ayuda</span>
    </a>
    <a href="#" class="dropdown-item">
      <i class="ni ni-support-16"></i>
      <span>Configuracion</span>
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-user-run"></i>
      <span>Salir</span>
      <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
        @csrf
      </form>
    </a>
  </div>
  <li class="nav-item px-3 d-flex align-items-center">
    <p class="text-md text-white mb-0">
        <i class="fa fa-clock me-1" style="color: white;"></i>
        {{ now('America/La_Paz')->format('H:i') }} <!-- Mostrar la hora actual en Bolivia -->
    </p>
</li>
</li>
