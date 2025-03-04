<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Oficina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Incluir encabezado -->
    @include('layouts.header')

    <div class="container mt-5">
        <h2 class="mb-4">Editar Oficina</h2>

        <form action="{{ route('oficinas.update', $oficina->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Esto indica que estamos haciendo una actualización -->

            <!-- Campo para el nombre de la oficina -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $oficina->nombre) }}" required>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para la dirección de la oficina -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $oficina->direccion) }}" required>
                @error('direccion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary mb-3">Guardar Cambios</button>
            <a href="{{ route('oficinas.index') }}" class="btn btn-secondary mb-3">Volver</a>
        </form>
    </div>

    <!-- Incluir pie de página -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
