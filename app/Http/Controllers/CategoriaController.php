<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Inertia\Inertia;
use Laravel\Mcp\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return Inertia::render('Categorias/Index', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Categorias/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        try {
            $validated = $request->validated([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'prefijo' => 'required|string|max:10',
                'tipo' => 'required|string|max:255',
            ]);
            Categoria::create($validated);
            return redirect()
                        ->route('categorias.index')
                        ->with('success', 'Categoria creada correctamente');
        } catch (\Exception $e) {
            return redirect()
                        ->back()
                        ->with('error', 'Error al crear la categoria: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return Inertia::render('Categorias/Edit', [
            'categoria' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        try {
            $validated = $request->validated([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'prefijo' => 'required|string|max:10',
                'tipo' => 'required|string|max:255',
            ]);
            $categoria->update($validated);
            return redirect()
                        ->route('categorias.index')
                        ->with('success', 'Categoria actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()
                        ->back()
                        ->with('error', 'Error al actualizar la categoria: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Categoria $categoria)
    {
        try {
            if($categoria->activos()->exists() || $categoria->consumibles()->exists()) {
                return redirect()
                            ->back()
                            ->with('error', 'No se puede eliminar la categoria porque tiene registros asociados');
            }
            $categoria->delete();
            return redirect()
                        ->route('categorias.index')
                        ->with('success', 'Categoria eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()
                        ->back()
                        ->with('error', 'Error al eliminar la categoria: ' . $e->getMessage());
        }
    }
}
