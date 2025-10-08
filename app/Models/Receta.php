<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'recetas';

    protected $fillable = ['paciente_id','medico_id','descripcion','fecha'];

    public function paciente() {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function medico() {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}

