<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
    ];

    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }
}
