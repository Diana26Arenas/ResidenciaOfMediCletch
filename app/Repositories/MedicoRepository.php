<?php

namespace App\Repositories;

use App\Models\Medico;

class MedicoRepository
{
    // Conecta con el Modelo Medico para las consultas a la BD
    public function getAll()
    {
        return Medico::all();
    }
    // ... otros métodos (create, find, update, delete)
}