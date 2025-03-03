<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Empleado</h2>

        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre *</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->nombre }}" required>
            </div>

            <div class="mb-3">
                <label for="primer_apellido" class="form-label">Primer Apellido *</label>
                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ $empleado->primer_apellido }}" required>
            </div>

            <div class="mb-3">
                <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ $empleado->segundo_apellido }}">
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <input type="text" class="form-control" id="rol" name="rol" value="{{ $empleado->rol }}">
            </div>

            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $empleado->fecha_nacimiento }}">
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label">DNI *</label>
                <input type="text" class="form-control" id="dni" name="dni" value="{{ $empleado->dni }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $empleado->email }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('oficinas.show', $empleado->oficina_id) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
