<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\OficinaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('oficinas.index');
});

Route::post('empleados/{empleado}/move', [EmpleadoController::class, 'moveToDepartment'])->name('empleados.move');


Route::resource('oficinas', OficinaController::class);

Route::get('oficinas/{oficina}/empleados/create', [EmpleadoController::class, 'create'])
    ->name('empleados.create');

Route::resource('empleados', EmpleadoController::class)->except(['create']);
