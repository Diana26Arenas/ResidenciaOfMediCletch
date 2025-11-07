<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Lógica de negocio y manejo de errores
    public function create(array $data)
    {
        try {
            // Lógica de negocio: hashear contraseña antes de guardar
            $data['password'] = Hash::make($data['password']);

            return $this->userRepository->create($data);

        } catch (Exception $e) {
            // Captura de errores de base de datos o lógica
            throw new Exception("Error al crear el usuario: " . $e->getMessage());
        }
    }
    
    // Lógica de negocio para ver todos
    public function getAll()
    {
        return $this->userRepository->getAll();
    }
    // ... otros métodos
}