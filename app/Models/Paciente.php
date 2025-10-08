<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'nombre','apellido','email','telefono','fecha_nacimiento','direccion','sexo'
    ];

    public function citas() {
        return $this->hasMany(CitaConsulta::class, 'paciente_id');
    }

    public function historial() {
        return $this->hasMany(HistorialMedico::class, 'paciente_id');
    }

    public function ventas() {
        return $this->hasMany(Venta::class, 'paciente_id');
    }

    public function recetas() {
        return $this->hasMany(Receta::class, 'paciente_id');
    }
}
