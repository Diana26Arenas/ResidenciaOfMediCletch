<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class MedicoController extends Controller
{
    /**
     * Devuelve una lista de todos los médicos, incluyendo su usuario asociado (Ruta GET /api/medicos)
     */
    public function index()
    {
        // Importante: Usamos with('user') para cargar la información de login (email)
        $medicos = Medico::with('user')->get();
        return response()->json(['data' => $medicos]);
    }

    /**
     * Almacena un médico y crea la cuenta de usuario asociada (Ruta POST /api/medicos)
     */
    public function store(Request $request)
    {
        // 1. Validación de la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'consultorio_id' => 'nullable|integer',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        DB::beginTransaction();

        try {
            // 2. Crear el registro del usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'medico', // Asignamos el rol de médico
            ]);

            // 3. Crear el registro del médico
            $medico = Medico::create([
                'name' => $request->name,
                'specialty' => $request->specialty,
                'consultorio_id' => $request->consultorio_id,
                'user_id' => $user->id, // Vinculamos al usuario recién creado
            ]);
            
            // Cargar la relación 'user' antes de retornar, necesario para que el frontend lo tenga
            $medico->load('user');

            DB::commit();

            // Retorna el médico creado con código 201 (Created)
            return response()->json($medico, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            // Retorna un error 500 si la transacción falla
            return response()->json(['message' => 'Error al crear el médico y el usuario: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Actualiza un médico y opcionalmente su cuenta de usuario (Ruta PUT/PATCH /api/medicos/{id})
     */
    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);
        $user = User::findOrFail($medico->user_id);

        // 1. Validación de la solicitud para la actualización
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'consultorio_id' => 'nullable|integer',
            // El email es único EXCEPTO para el usuario actual
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            // 2. Actualizar el registro del médico
            $medico->update($request->only(['name', 'specialty', 'consultorio_id']));

            // 3. Actualizar el registro del usuario (opcional)
            $userData = ['name' => $request->name];
            
            // Solo actualizar la contraseña si se proporciona una nueva
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            
            // Solo actualizar el email si se proporciona uno
            if ($request->filled('email')) {
                $userData['email'] = $request->email;
            }

            $user->update($userData);

            DB::commit();

            // Cargar la relación 'user' antes de retornar
            $medico->load('user');

            // Retorna el médico actualizado
            return response()->json($medico);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al actualizar el médico y/o el usuario: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Elimina el registro del médico y su usuario asociado (Ruta DELETE /api/medicos/{id})
     */
    public function destroy($id)
    {
        // Usamos la transacción para asegurar la limpieza total
        DB::beginTransaction();
        
        try {
            $medico = Medico::findOrFail($id);
            
            // 1. Obtener el ID del usuario asociado
            $userId = $medico->user_id;
            
            // 2. Eliminar el registro del médico
            $medico->delete();

            // 3. Eliminar el usuario asociado
            User::destroy($userId);
            
            DB::commit();

            // Responde con un código de éxito 204 (No Content)
            return response()->json(null, 204);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al eliminar el médico y/o el usuario: ' . $e->getMessage()], 500);
        }
    }
}