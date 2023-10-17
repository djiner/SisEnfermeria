<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<ul class="navbar-nav">
    <li class="nav-item  active ">
      <a class="nav-link  active " href="{{ url('/dashboard')}}">
        <i class="ni ni-tv-2 text-danger"></i> MENU PRINCIPAL
      </a>
    </li>


    <style>
        /* Estilo para la tabla del menú */
        table.dropdown-menu {
            width: 100%;
            border-collapse: collapse; /* Fusionar los bordes de la tabla */
        }
      /* Estilo CSS para ajustar el ancho del botón */
      .btn-group {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
      }

      .btn-group > .btn {
        width: 300px; /* Ajusta el valor del ancho según tus necesidades */
        margin-right: 0; /* Ajusta el margen derecho para mover el botón hacia la derecha */
      }

      .btn-group > .dropdown-menu {
        width: 200px; /* Ancho fijo del menú desplegable */
      }
      ul.dropdown-menu {
    text-align: right; /* Alinea todo el texto a la derecha */
        }

        /* Estilo para los elementos de la lista */
        ul.dropdown-menu li {
            border-bottom: 1px solid #0e0000; /* Línea divisoria inferior */
            padding: 5px 0; /* Espaciado vertical entre elementos */
        }

        /* Estilo para los enlaces */
        ul.dropdown-menu a {
            color: red;
            text-decoration: none; /* Elimina el subrayado de los enlaces */
        }

    </style>


    <div class="btn-group">
      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
        USUARIOS <span class="caret"></span>
      </button>

      <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('usuarios')}}">Usuarios Registrados</a></li>
        <li><a href="{{ url('')}}" >Perfiles de Usuario</a></li>
        <li><a href="{{ url('')}}" >Cambiar Contraseña</a></li>
      </ul>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
        ENFERMERAS <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('enfermeras')}}" >Enfermeras Registradas</a></li>
            <li><a href="{{ url('especialidades')}}" >Especialidad</a></li>
            <li><a href="{{ url('horario')}}" >Horario</a></li>
            <li><a href="pacientes" >Historial de pacientes</a></li>
        </ul>
      </div>


      <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
        PACIENTES <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('pacientes')}}" >Pacientes</a></li>
            <li><a href="citas" >Historial de Citas</a></li>
            <li><a href="citas" >Citas Confirmadas</a></li>
            <li><a href="citas" >citas Programadas</a></li>
            <li><a href="citas" >Programar Nueva Cita</a></li>
        </ul>
      </div>


      <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
        CITAS <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('citas')}}" >Detalles de Citas Programadas</a></li>
            <li><a href="cita" >Historial de Citas</a></li>
            <li><a href="cita" >Uvicacion de la Cita</a></li>
            <li><a href="cita" >Calendario de Citas</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
        SERVICIOS<span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('citas')}}" >Descripción de Servicios</a></li>
            <li><a href="miscitas" >Solicitar Servicios Enfermera</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
        GEOLOCALIZACIÓN<span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('localizacion')}}" >Mapa Interactivo de Ubicaciones</a></li>
            <li><a href="localizacion" >Información Detallada de Ubicaciones </a></li>
            <li><a href="localizacion.show" >Uvicacion de Enfermeras</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
        NOTA EVALUACIÓN<span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('enfermera')}}" >Historial Médico del Paciente</a></li>
            <li><a href="enfermera" >Diagnosticar y Tratar en Notas de Evaluación</a></li>
            <li><a href="paciente" >Comentarios y Comunicación Médica</a></li>
        </ul>
      </div>

    <!-- Divider -->
    <hr class="my-3">

    <!-- Navigation -->
    <li class="nav-item">
      <a class="nav-link" href="#" >
        <i class="fas fa-wallet text-danger"></i> REPORTES
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="fas fa-sign-in-alt"></i> Cerrar Sesión
      </a>
      <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
        @csrf
      </form>
    </li>
  </ul>
      </ul>
    </div>
  </nav>

