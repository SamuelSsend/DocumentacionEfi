<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarritoSubproducto extends Model
{
    protected $table = 'carrito_subproductos';

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'registro_id');
    }
    
    public function subproductos()
    {
        return $this->belongsTo(Subproducto::class, 'subproducto_id');
    }
   
}
