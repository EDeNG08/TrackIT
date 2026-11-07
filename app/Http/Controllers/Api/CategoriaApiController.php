<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return response()->json([
            'success' => true,
            'data' => $categorias
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validated([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'prefijo' => 'required|string|max:10',
                'tipo' => 'required|string|max:255',
            ]);
            $categoria = Categoria::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Categoria creada correctamente',
                'data' => $categoria
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la categoria: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return response()->json([
            'success' => true,
            'data' => $categoria
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        try {
            $validated = $request->validated([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'prefijo' => 'required|string|max:10',
                'tipo' => 'required|string|max:255',
            ]);
            $categoria->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Categoria actualizada correctamente',
                'data' => $categoria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la categoria: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        try {
            if($categoria->activos()->exists() || $categoria->consumibles()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la categoria porque tiene registros asociados'
                ], 422);
            }
            $categoria->delete();
            return response()->json([
                'success' => true,
                'message' => 'Categoria eliminada correctamente',
                'data' => $categoria
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la categoria: ' . $e->getMessage()
            ], 500);
        }
    }
}
