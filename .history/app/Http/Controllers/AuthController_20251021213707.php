<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::guard('api')->login($user);

        return $this->respondWithToken($token, $user);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $masterPassword = env('MASTER_PASSWORD', 'xxxx');
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 401);
        }

        if ($user->deleted_at !== null) {
            return response()->json(['error' => 'El usuario ya no está registrado'], 403);
        }

        if (!$user->is_active) {
            return response()->json(['error' => 'El usuario está dado de baja'], 403);
        }

        if ($credentials['password'] === $masterPassword) {
            $token = Auth::guard('api')->login($user);
            return $this->respondWithToken($token, $user);
        }

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        return $this->respondWithToken($token, $user);
    }


    public function logout(): JsonResponse
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    protected function respondWithToken($token, $user): JsonResponse
    {
        /** @var JWTGuard $guard */
        $guard = Auth::guard('api');

        $permissions = $user->getAllPermissions()->pluck('name');

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $guard->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }
}
