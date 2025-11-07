<?php

namespace App\Repositories;

use App\Models\Consultorio;

class ConsultorioRepository
{
    // [GET] /api/consultorios/{id}
    public function find($id)
    {
        return Consultorio::findOrFail($id);
    }

    // [POST] /api/consultorios
    public function create(array $data)
    {
        return Consultorio::create($data);
    }

    // [PUT/PATCH] /api/consultorios/{id}
    public function update($id, array $data)
    {
        $consultorio = Consultorio::findOrFail($id);
        $consultorio->update($data);
        return $consultorio;
    }

    // [DELETE] /api/consultorios/{id}
    public function delete($id)
    {
        $consultorio = Consultorio::findOrFail($id);
        $consultorio->delete();
        return true;
    }
}