<?php

namespace App\Services;

use App\Repositories\MedicoRepository;

class MedicoService
{
    protected $medicoRepository;

    public function __construct(MedicoRepository $medicoRepository)
    {
        $this->medicoRepository = $medicoRepository;
    }

    // Aquí irá toda la lógica de negocio, try-catch, validaciones, etc.
    public function getAll()
    {
        return $this->medicoRepository->getAll();
    }
    // ... otros métodos (create, update, delete)
}