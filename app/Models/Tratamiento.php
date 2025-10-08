<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamientos';

    protected $fillable = [
        'cita_id','medicamento_id','dosis','duracion','descripcion'
    ];

    public function cita() {
        return $this->belongsTo(CitaConsulta::class, 'cita_id');
    }

    public function medicamento() {
        return $this->belongsTo(Medicamento::class, 'medicamento_id');
    }
}

