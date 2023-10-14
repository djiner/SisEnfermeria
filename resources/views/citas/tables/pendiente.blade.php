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
          <th scope="col">Hora</th>
          <th scope="col">Tipo</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($Pendientecitas as $cita)
        <tr>
          <th scope="row">
            {{ $cita->descripcion }}
          </th>
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

            @if ($role == 'enfermera' || $role == 'admin')
              <form action="{{ url('/citas/'.$cita->id.'/confirmar') }}"
                method="POST" class="d-inline-block">
                @csrf
                <button class="btn btn-sm btn-success" type="submit"
                  data-toggle="tooltip" title="Confirmar cita">
                  <i class="ni ni-check-bold"></i>
                </button>
              </form>
            @endif

            <form action="{{ url('/citas/'.$cita->id.'/cancelar') }}"
              method="POST" class="d-inline-block">
              @csrf

              <button class="btn btn-sm btn-danger" type="submit"
                data-toggle="tooltip" title="Cancelar cita">
                <i class="ni ni-fat-delete"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="card-body">
    {{ $pendientecitas->links() }}
  </div>
