<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('layouts.header')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Lista de Empleados</h2>



        @if ($empleados->isEmpty())
            <p>No hay empleados registrados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">DNI</th>
                        <th class="text-center">Departamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td class="text-center"><img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto del empleado" width="100" height="100"></td>
                            <td class="text-center">{{ $empleado->nombre }}</td>
                            <td class="text-center">{{ $empleado->dni }}</td>
                            <td class="text-center">{{ $empleado->oficina->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Volver</a>
    </div>

    @include('layouts.footer')
</body>
</html>
