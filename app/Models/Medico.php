<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    use HasFactory;

    protected $table = 'medicos';

    protected $fillable = [
        'nombre','apellido','especialidad','email','telefono','cedula'
    ];

    public function citas() {
        return $this->hasMany(CitaConsulta::class, 'medico_id');
    }

    public function recetas() {
        return $this->hasMany(Receta::class, 'medico_id');
    }
}

