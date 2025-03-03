<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Oficina;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($oficinaId)
    {
        $oficina = Oficina::findOrFail($oficinaId);
        return view('empleados.create', compact('oficina'));
    }


    // Almacena un nuevo empleado en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:9|unique:empleados,dni',
            'email' => 'required|email|unique:empleados,email',
            'oficina_id' => 'required|exists:oficinas,id'
        ]);

        Empleado::create($request->all());

        return redirect()->route('oficinas.show', $request->oficina_id)
                         ->with('success', 'Empleado añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $empleado->update($request->all());

        return redirect()->route('oficinas.show', $empleado->oficina_id)
                         ->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
