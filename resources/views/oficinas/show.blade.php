<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Oficina</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Oficina: {{ $oficina->nombre }}</h2>
        <p><strong>Dirección:</strong> {{ $oficina->direccion ?? 'No especificada' }}</p>

        <a href="{{ route('empleados.create', $oficina->id) }}" class="btn btn-primary mb-3">Añadir Empleado</a>
        <a href="{{ route('oficinas.index') }}" class="btn btn-secondary mb-3">Volver</a>

        <h3>Empleados</h3>
        @if ($oficina->empleados->isEmpty())
            <p>No hay empleados en esta oficina.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($oficina->empleados as $empleado)
                        <tr>
                            <td>
                                <a href="{{ route('empleados.edit', $empleado->id) }}">
                                    {{ $empleado->nombre }}
                                </a>
                            </td>
                            <td>{{ $empleado->dni }}</td>
                            <td>
                                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
