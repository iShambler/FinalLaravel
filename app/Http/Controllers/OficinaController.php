<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\Request;
use App\Models\Empleado;

class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oficinas = Oficina::all();
        return view('oficinas.index', compact('oficinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('oficinas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
        ]);

        $oficina = new Oficina();
        $oficina->nombre = $request->input('nombre');
        $oficina->direccion = $request->input('direccion');
        $oficina->save();

        return redirect()->route('oficinas.index')->with('success', 'Oficina creada correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Oficina $oficina)
    {
        $oficinas = Oficina::all();
        return view('oficinas.show', compact('oficina', 'oficinas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Buscar la oficina por su id
        $oficina = Oficina::findOrFail($id);

        // Retornar la vista 'edit' con la oficina cargada
        return view('oficinas.edit', compact('oficina'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de la oficina
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ]);

        // Buscar la oficina por su id
        $oficina = Oficina::findOrFail($id);

        // Actualizar los datos de la oficina
        $oficina->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('oficinas.index')
                         ->with('success', 'Oficina actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oficina $oficina)
    {
        // Verificar si la oficina tiene empleados
        if ($oficina->empleados->isEmpty()) {
            $oficina->delete();
            return redirect()->route('oficinas.index')->with('success', 'Oficina eliminada correctamente.');
        } else {
            return redirect()->route('oficinas.show', $oficina->id)->with('error', 'No se puede eliminar la oficina porque tiene empleados asignados.');
        }
    }




}
