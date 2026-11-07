<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::paginate(10);
        return Inertia::render('Departamentos/Index', [
            'departamentos' => $departamentos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Departamentos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'codigo_area' => 'required|string|max:255',
                'responsable_area' => 'nullable|string|max:255',
                'estado_area' => 'required|boolean',
            ]);
            $departamento = Departamento::create($validated);
            return redirect()
                    ->route('departamentos.index')
                    ->with('success', 'Departamento creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el departamento: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamento $departamento)
    {
        return Inertia::render('Departamentos/Edit', [
            'departamento' => $departamento
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departamento $departamento)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'codigo_area' => 'required|string|max:255',
                'responsable_area' => 'nullable|string|max:255',
                'estado_area' => 'required|boolean',
            ]);
            $departamento->update($validated);
            return redirect()
                    ->route('departamentos.index')
                    ->with('success', 'Departamento actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el departamento: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Departamento $departamento)
    {
        try {
            if($request->user()->cannot('delete', $departamento)) {
                return redirect()->back()->with('error', 'No tienes permisos para eliminar este departamento');
            } else if ($departamento->empleados->exists()) {
                return redirect()->back()->with('error', 'No se puede eliminar el departamento porque tiene empleados asignados');
            }
            $departamento->delete();
            return redirect()
                    ->route('departamentos.index')
                    ->with('success', 'Departamento eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el departamento: ' . $e->getMessage());
        }
    }
}
