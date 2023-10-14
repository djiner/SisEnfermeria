<div class="table-responsive">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">Especialidad</th>
          <th scope="col">Fecha</th>
          <th scope="col">Horario</th>
          <th scope="col">Estado</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($historialCitas as $cita)
        <tr>
          <th scope="row">
            {{ $cita->especialidad->name }}
          </th>
          <td>
            {{ $cita->horario_date }}
          </td>
          <td>
            {{ $cita->horario_time_12 }}
          </td>
          <td>
            {{ $cita->estado }}
          </td>
          <td>
            <a href="{{ url('/citas/'.$cita->id) }}" class="btn btn-primary btn-sm">
              Ver
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="card-body">
    {{ $historialCitas->links() }}
  </div>
