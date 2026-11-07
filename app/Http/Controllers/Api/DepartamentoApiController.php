<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Departamento::paginate(10);
        return response()->json([
            'success' => true,
            'data' => $departamentos,
        ], 200);
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

            return response()->json([
                'success' => true,
                'message' => 'Departamento creado correctamente',
                'data' => $departamento,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el departamento: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Departamento $departamento)
    {
        return response()->json([
            'success' => true,
            'data' => $departamento,
        ], 200);
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
            return response()->json([
                'success' => true,
                'message' => 'Departamento actualizado correctamente',
                'data' => $departamento,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el departamento: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Departamento $departamento)
    {
        try {
            if($request->user()->cannot('delete', $departamento)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No tienes permisos para eliminar este departamento',
                ], 403);
            } else if ($departamento->empleados->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar el departamento porque tiene empleados asignados',
                ], 422);
            }
            $departamento->delete();
            return response()->json([
                'success' => true,
                'message' => 'Departamento eliminado correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el departamento: ' . $e->getMessage(),
            ], 500);
        }
    }
}
