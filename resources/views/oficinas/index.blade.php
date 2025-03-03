<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oficinas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Oficinas</h1>
        <a href="{{ route('oficinas.create') }}" class="btn btn-primary mb-3">Crear Oficina</a>

        @if ($oficinas->isEmpty())
            <p class="text-muted">No hay oficinas registradas.</p>
        @else
            <ul class="list-group">
                @foreach ($oficinas as $oficina)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $oficina->nombre }} - {{ $oficina->direccion }}</span>
                        <a href="{{ route('oficinas.show', $oficina->id) }}" class="btn btn-info btn-sm">Detalles</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
