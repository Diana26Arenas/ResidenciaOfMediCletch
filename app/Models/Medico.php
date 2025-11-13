<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'specialty', 
        'consultorio_id', 
        'user_id' // Clave foránea para la relación con el usuario (login)
    ];

    /**
     * Define la relación: Un médico pertenece a un usuario (la cuenta de login).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}