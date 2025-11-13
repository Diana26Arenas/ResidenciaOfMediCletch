<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultorioController extends Controller
{
    /**
     * Display a listing of the resource.
     * Devuelve una lista de todos los consultorios. (GET /api/consultorios)
     */
    public function index()
    {
        // Retorna todos los consultorios
        $consultorios = Consultorio::all();
        return response()->json(['data' => $consultorios]);
    }

    /**
     * Store a newly created resource in storage.
     * Almacena un nuevo consultorio. (POST /api/consultorios)
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_consultorio' => 'required|string|max:255|unique:consultorios,numero_consultorio',
            'piso' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        try {
            $consultorio = Consultorio::create($request->all());
            return response()->json($consultorio, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear el consultorio: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * Actualiza el consultorio especificado. (PUT/PATCH /api/consultorios/{id})
     */
    public function update(Request $request, $id)
    {
        $consultorio = Consultorio::findOrFail($id);

        $request->validate([
            // El numero_consultorio debe ser único, excluyendo el consultorio actual
            'numero_consultorio' => 'required|string|max:255|unique:consultorios,numero_consultorio,' . $id,
            'piso' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        try {
            $consultorio->update($request->all());
            return response()->json($consultorio);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el consultorio: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * Elimina el consultorio especificado. (DELETE /api/consultorios/{id})
     */
    public function destroy($id)
    {
        $consultorio = Consultorio::findOrFail($id);

        // Opcional: Verificar si hay médicos asignados
        if ($consultorio->medicos()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el consultorio porque tiene médicos asignados. Reasigna o elimina primero a esos médicos.'
            ], 409); // 409 Conflict
        }

        try {
            $consultorio->delete();
            return response()->json(null, 204); // 204 No Content
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el consultorio: ' . $e->getMessage()], 500);
        }
    }
}