<?php

namespace App\Services;

use App\Repositories\ConsultorioRepository;
use Exception;

class ConsultorioService
{
    protected $consultorioRepository;

    public function __construct(ConsultorioRepository $consultorioRepository)
    {
        $this->consultorioRepository = $consultorioRepository;
    }

    // [GET /api/consultorios/{id}]
    public function find($id)
    {
        try {
            return $this->consultorioRepository->find($id);
        } catch (Exception $e) {
            // Manejo de error si no se encuentra el ID
            throw new Exception("Consultorio no encontrado.", 404); 
        }
    }

    // [POST /api/consultorios] - Lógica para crear
    public function create(array $data)
    {
        try {
            // **Aquí iría validación de datos y lógica de negocio específica**
            // Por ejemplo: if ($data['nombre'] == 'bloqueado') { throw new Exception(...) }

            return $this->consultorioRepository->create($data);
        } catch (Exception $e) {
            // Captura de errores de la BD o lógica de negocio
            throw new Exception("Error al crear el consultorio: " . $e->getMessage());
        }
    }
    
    // [DELETE /api/consultorios/{id}] - Lógica para eliminar
    public function delete($id)
    {
        try {
            return $this->consultorioRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el consultorio o ID no encontrado: " . $e->getMessage(), 404);
        }
    }

    // **Nota:** Los métodos 'getAll' y 'update' siguen un patrón similar.
}