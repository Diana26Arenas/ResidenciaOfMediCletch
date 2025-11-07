<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    // Conecta con la BD para crear un nuevo registro
    public function create(array $data)
    {
        // Se asume que la contraseña ya está hasheada
        return User::create($data);
    }
    
    // Conecta con la BD para encontrar todos los registros
    public function getAll()
    {
        return User::all();
    }
    // ... otros métodos (find, update, delete)
}