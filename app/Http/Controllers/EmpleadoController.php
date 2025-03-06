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

        $empleados = Empleado::with('oficina')->get();


        return view('empleados.index', compact('empleados'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($oficinaId)
    {
        $oficina = Oficina::findOrFail($oficinaId);
        return view('empleados.create', compact('oficina'));
    }



    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:9|unique:empleados,dni',
            'email' => 'required|email|unique:empleados,email',
            'oficina_id' => 'required|exists:oficinas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',  // Validación de la foto
        ]);


        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('employees', 'public');
        }

        // Crear el empleado
        Empleado::create([
            'nombre' => $request->nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'rol' => $request->rol,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'dni' => $request->dni,
            'email' => $request->email,
            'oficina_id' => $request->oficina_id,
            'foto' => $fotoPath,
        ]);


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

        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:9|unique:empleados,dni,' . $empleado->id,
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validación para la foto
        ]);


        if ($request->hasFile('foto')) {

            if ($empleado->foto && file_exists(storage_path('app/public/' . $empleado->foto))) {
                unlink(storage_path('app/public/' . $empleado->foto)); // Eliminar la foto anterior
            }


            $fotoPath = $request->file('foto')->store('fotos_empleados', 'public');
        } else {

            $fotoPath = $empleado->foto;
        }


        $empleado->update([
            'nombre' => $request->nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'rol' => $request->rol,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'dni' => $request->dni,
            'email' => $request->email,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('oficinas.show', $empleado->oficina_id)
                         ->with('success', 'Empleado actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {

        $empleado->delete();


        return redirect()->route('oficinas.show', $empleado->oficina_id)
                         ->with('success', 'Empleado eliminado correctamente.');
    }


    public function moveToDepartment(Request $request, Empleado $empleado)
    {

        $request->validate([
            'oficina_id' => 'required|exists:oficinas,id',
            'current_oficina_id' => 'required|exists:oficinas,id',
        ]);


        $oficinaOrigen = $request->current_oficina_id;


        $empleado->update([
            'oficina_id' => $request->oficina_id,
        ]);

        
        return redirect()->route('oficinas.show', $oficinaOrigen)
                         ->with('success', 'Empleado movido a un nuevo departamento correctamente.');
    }


}
