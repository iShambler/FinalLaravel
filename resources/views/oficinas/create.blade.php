<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Oficina</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('layouts.header')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Añadir Oficina</h2>

        <form action="{{ route('oficinas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Oficina</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('oficinas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    @include('layouts.footer')
</body>
</html>
