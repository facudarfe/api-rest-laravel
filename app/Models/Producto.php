<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
    ];
    protected $hidden = ['pivot'];

    public function proveedores(){
        return $this->belongsToMany(Proveedor::class, 'proveedores_productos', 'producto_id', 'proveedor_id');
    }
}
