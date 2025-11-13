<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Los atributos que se pueden asignar masivamente.
     * @var array<int, string>
     */
    protected $fillable = [
        'numero_consultorio',
        'piso',
        'descripcion',
    ];

    /**
     * Define la relación inversa con Medico.
     * Un consultorio puede tener varios médicos asignados.
     */
    public function medicos()
    {
        // El consultorio tiene la clave foránea en la tabla medicos (consultorio_id)
        return $this->hasMany(Medico::class, 'consultorio_id');
    }
}