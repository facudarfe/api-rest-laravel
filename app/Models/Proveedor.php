<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $fillable = ['nombre', 'direccion', 'telefono', 'email'];

    public function productos(){
        return $this->belongsToMany(Producto::class, 'proveedores_productos', 'proveedor_id', 'producto_id')->withPivot('cantidad');
    }
}
