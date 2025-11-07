<?php

namespace App\Http\Controllers;

use App\Services\ConsultorioService;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    protected $consultorioService;

    public function __construct(ConsultorioService $consultorioService)
    {
        $this->consultorioService = $consultorioService;
    }
    
    // index() ya implementado (GET /api/consultorios)

    // show: [GET /api/consultorios/{id}]
    public function show($id)
    {
        try {
            $consultorio = $this->consultorioService->find($id);
            return response()->json($consultorio, 200);
        } catch (\Exception $e) {
            // El Service lanza 404 si no encuentra el ID
            return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 500);
        }
    }

    // store: [POST /api/consultorios]
    public function store(Request $request)
    {
        // **Recomendación:** Agregar validación aquí (ej: $request->validate([...]))

        try {
            $consultorio = $this->consultorioService->create($request->all());
            return response()->json($consultorio, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    // ... update y destroy siguen el mismo patrón de try-catch y llamada al Service.
}