<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oficinas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include ('layouts.header')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Oficinas</h1>
        <div class="d-flex justify-content-between mb-3">
            <!-- Botones "Crear Oficina" y "Ver todos los empleados" alineados -->
            <a href="{{ route('oficinas.create') }}" class="btn btn-primary">Crear Oficina</a>
            <a href="{{ route('empleados.index') }}" class="btn btn-primary">Ver todos los empleados</a>
        </div>

        @if ($oficinas->isEmpty())
            <p class="text-muted">No hay oficinas registradas.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($oficinas as $oficina)
                        <tr>
                            <!-- El nombre ahora es un enlace a los detalles de la oficina -->
                            <td><a class="text-decoration-none" href="{{ route('oficinas.show', $oficina->id) }}">{{ $oficina->nombre }}</a></td>
                            <td>{{ $oficina->direccion }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <!-- Formulario de Eliminar Oficina -->
                                    <form action="{{ route('oficinas.destroy', $oficina->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('¿Estás seguro de que deseas eliminar esta oficina? Esta acción no se puede deshacer.')">
                                            Eliminar Oficina
                                        </button>
                                    </form>
                                    <!-- Editar Oficina con el ID correcto -->
                                    <a href="{{ route('oficinas.edit', $oficina->id) }}" class="btn btn-primary btn-sm">Editar Oficina</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
    @include ('layouts.footer')
</body>
</html>
