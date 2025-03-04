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
        // Obtener todos los empleados con la relación de oficina
        $empleados = Empleado::with('oficina')->get();

        // Pasar los empleados a la vista
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


    // Almacena un nuevo empleado en la base de datos
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

        // Cargar la foto si existe
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
            'foto' => $fotoPath,  // Almacenar la ruta de la foto
        ]);

        // Redirigir con mensaje de éxito
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
        // Validación de los datos, incluyendo la foto
        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:9|unique:empleados,dni,' . $empleado->id,
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validación para la foto
        ]);

        // Si se sube una nueva foto, la manejamos
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior si existe
            if ($empleado->foto && file_exists(storage_path('app/public/' . $empleado->foto))) {
                unlink(storage_path('app/public/' . $empleado->foto)); // Eliminar la foto anterior
            }

            // Guardar la nueva foto
            $fotoPath = $request->file('foto')->store('fotos_empleados', 'public');
        } else {
            // Si no se sube una nueva foto, mantener la foto actual
            $fotoPath = $empleado->foto;
        }

        // Actualizamos los demás datos
        $empleado->update([
            'nombre' => $request->nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'rol' => $request->rol,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'dni' => $request->dni,
            'email' => $request->email,
            'foto' => $fotoPath, // Asignamos la nueva ruta de la foto (si se subió)
        ]);

        return redirect()->route('oficinas.show', $empleado->oficina_id)
                         ->with('success', 'Empleado actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        // Eliminar el empleado
        $empleado->delete();

        // Redirigir de vuelta a la oficina, con un mensaje de éxito
        return redirect()->route('oficinas.show', $empleado->oficina_id)
                         ->with('success', 'Empleado eliminado correctamente.');
    }


    public function moveToDepartment(Request $request, Empleado $empleado)
    {
        // Validamos que el nuevo departamento exista
        $request->validate([
            'oficina_id' => 'required|exists:oficinas,id',
            'current_oficina_id' => 'required|exists:oficinas,id', // Agregamos validación de la oficina actual
        ]);

        // Guardamos la oficina de origen antes de actualizar
        $oficinaOrigen = $request->current_oficina_id;

        // Actualizamos la oficina del empleado
        $empleado->update([
            'oficina_id' => $request->oficina_id,
        ]);

        // Redirigimos a la oficina original (mantenerse en la misma)
        return redirect()->route('oficinas.show', $oficinaOrigen)
                         ->with('success', 'Empleado movido a un nuevo departamento correctamente.');
    }


}
