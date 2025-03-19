<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{

    protected $table = 'cupon';
    public $timestamps = false;
    
    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'carrito_cupon')
            ->withPivot('descuento_aplicado')
            ->withTimestamps();
    }
}
