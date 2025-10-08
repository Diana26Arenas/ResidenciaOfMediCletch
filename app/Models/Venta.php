<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = ['paciente_id','fecha','total','metodo_pago'];

    public function paciente() {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function facturas() {
        return $this->hasMany(Factura::class, 'venta_id');
    }
}
