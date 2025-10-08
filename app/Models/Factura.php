<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = ['venta_id','numero','monto','fecha'];

    public function venta() {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
}

