<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Oficina</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include ('layouts.header')

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Oficina: {{ $oficina->nombre }}</h2>

        <a href="{{ route('empleados.create', $oficina->id) }}" class="btn btn-primary mb-3">Añadir Empleado</a>



        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h3>Empleados de {{ $oficina->nombre }}</h3>
        @if ($oficina->empleados->isEmpty())
            <p>No hay empleados en esta oficina.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center align-middle">Nombre</th>
                        <th class="text-center align-middle">Foto</th>
                        <th class="text-center align-middle">DNI</th>
                        <th class="text-center align-middle">Mover empleado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($oficina->empleados as $empleado)
                        <tr>
                            <td class="text-center align-middle">
                                <a class="text-decoration-none" href="{{ route('empleados.edit', $empleado->id) }}">
                                    {{ $empleado->nombre }}
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto del empleado" width="100" height="100">
                            </td>
                            <td class="text-center align-middle">{{ $empleado->dni }}</td>
                            <td class="text-center align-middle" >
                             
                                <form action="{{ route('empleados.move', $empleado->id) }}" method="POST" class="d-inline d-flex justify-content-center align-items-center">
                                    @csrf
                                    <input type="hidden" name="current_oficina_id" value="{{ $oficina->id }}">

                                    <div class="form-group mb-0 mr-2 me-2" style="flex-grow: 0; width: auto;">
                                        <select name="oficina_id" class="form-control form-control-sm">
                                            <option value="">Seleccionar Departamento</option>
                                            @foreach ($oficinas as $oficinaOption)
                                                <option value="{{ $oficinaOption->id }}"
                                                    {{ $empleado->oficina_id == $oficinaOption->id ? 'selected' : '' }}>
                                                    {{ $oficinaOption->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-sm">Mover</button>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('oficinas.index') }}" class="btn btn-secondary mb-3">Volver</a>
    </div>
    @include ('layouts.footer')
</body>
</html>
