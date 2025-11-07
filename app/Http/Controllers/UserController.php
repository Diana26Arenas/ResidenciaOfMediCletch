<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    // Inyección de dependencias
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // [GET /api/users]
    public function index()
    {
        try {
            $users = $this->userService->getAll();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // [POST /api/users]
    public function store(Request $request)
    {
        // Se recomienda realizar la validación aquí o en una Request Form

        try {
            $user = $this->userService->create($request->all());
            return response()->json($user, 201); // 201 Created
        } catch (\Exception $e) {
            // Manejo de errores devueltos por la capa Service
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // ... métodos show, update, destroy
}