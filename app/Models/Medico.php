<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'especialidad',
        'email',
        'telefono',
        'consultorio_id',
    ];

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }
}
