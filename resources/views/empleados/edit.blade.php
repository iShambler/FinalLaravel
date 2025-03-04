<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include ('layouts.header')
    <div class="container mt-5">
        <h2 class="mb-4">Editar Empleado: {{ $empleado->nombre }}</h2>

        <!-- Formulario de edición -->
        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')  <!-- Método PUT para la actualización -->

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre *</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label for="primer_apellido" class="form-label">Primer Apellido *</label>
                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $empleado->primer_apellido) }}" required>
            </div>

            <div class="mb-3">
                <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $empleado->segundo_apellido) }}">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                @if ($empleado->foto)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto del empleado" width="100" height="100">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label">DNI *</label>
                <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $empleado->dni) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $empleado->email) }}" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('oficinas.show', $empleado->oficina_id) }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>

        <!-- Botón de eliminación (se puede agregar un formulario de eliminación) -->
        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar Empleado</button>
        </form>
    </div>
    @include ('layouts.footer')
</body>
</html>
