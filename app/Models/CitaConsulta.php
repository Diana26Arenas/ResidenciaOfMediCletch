<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaConsulta extends Model
{
    use HasFactory;

    protected $table = 'cita_consultas';

    protected $fillable = [
        'paciente_id','medico_id','consultorio_id','fecha_hora','estado','motivo'
    ];

    public function paciente() {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function medico() {
        return $this->belongsTo(Medico::class, 'medico_id');
    }

    public function consultorio() {
        return $this->belongsTo(Consultorio::class, 'consultorio_id');
    }

    public function tratamientos() {
        return $this->hasMany(Tratamiento::class, 'cita_id');
    }
}

