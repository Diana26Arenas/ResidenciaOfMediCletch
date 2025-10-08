<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre', 'email', 'password', 'rol'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relaciones
    public function citas() {
        return $this->hasMany(CitaConsulta::class, 'usuario_id');
    }
}

