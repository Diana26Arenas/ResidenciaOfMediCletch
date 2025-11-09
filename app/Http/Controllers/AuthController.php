<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Método auxiliar para responder con el token en el formato correcto
    protected function respondWithToken($token, $user = null, $statusCode = 200)
    {
        return response()->json([
            'access_token' => $token, // <-- CLAVE: 'access_token'
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => $user ?? Auth::guard('api')->user()
        ], $statusCode);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Genera el token e inicia sesión con el usuario recién creado
        $token = Auth::guard('api')->login($user);

        // Usa el método auxiliar para devolver el token con la clave 'access_token'
        return $this->respondWithToken($token, $user, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Intenta autenticar y obtener el token
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        // Usa el método auxiliar para devolver el token con la clave 'access_token'
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Sesión cerrada con éxito']);
    }

    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }
}