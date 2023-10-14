<div class="table-responsive">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Descripción</th>
          <th scope="col">Especialidad</th>
          @if ($role == 'paciente')
            <th scope="col">Enfermera</th>
          @elseif ($role == 'enfermera')
            <th scope="col">Paciente</th>
          @endif
          <th scope="col">Fecha</th>
          <th scope="col">Horario</th>
          <th scope="col">Tipo</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($confirmarCitas as $cita)
        <tr>
          <td>
            {{ $cita->descripcion }}
          </td>
          <td>
            {{ $cita->especialidad->name }}
          </td>
          @if ($role == 'paciente')
            <td>{{ $cita->enfermera->name }}</td>
          @elseif ($role == 'enfermera')
            <td>{{ $cita->paciente->name }}</td>
          @endif
          <td>
            {{ $cita->horario_date }}
          </td>
          <td>
            {{ $cita->horario_time_12 }}
          </td>
          <td>
            {{ $cita->type }}
          </td>
          <td>
            @if ($role == 'admin')
              <a class="btn btn-sm btn-primary" title="Ver cita"
                href="{{ url('/citas/'.$cita->id) }}">
                  Ver
              </a>
            @endif
            <a class="btn btn-sm btn-danger" title="Cancelar cita"
              href="{{ url('/citas/'.$cita->id.'/cancelar') }}">
                Cancelar
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="card-body">
    @if (Request::path() != 'home')
    {{ $confirmarCitas->links() }}
    @endif
  </div>
