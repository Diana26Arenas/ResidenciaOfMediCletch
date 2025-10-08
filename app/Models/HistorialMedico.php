<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medicos';

    protected $fillable = ['paciente_id','descripcion','fecha'];

    public function paciente() {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
