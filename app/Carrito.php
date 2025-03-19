<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Carrito extends Model
{
    protected $table = "carrito";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $guarded=[

    ];
    //MÉTODO PORQUE NO FUNCIONA ONDELETE('CASCADE')
    protected static function boot()
    {
        parent::boot();

        // Evento de eliminación antes de eliminar el registro principal
        static::deleting(
            function ($carrito) {
                // Eliminar los registros relacionados en carrito_subproducto
                DB::table('carrito_subproductos')
                    ->where('registro_id', $carrito->id)
                    ->delete();
            }
        );
    }

    public function subproductos()
    {
        return $this->hasMany(CarritoSubproducto::class, 'registro_id');
    }

    public function cupones()
    {
        return $this->belongsToMany(Cupon::class, 'carrito_cupon')
            ->withPivot('descuento_aplicado')
            ->withTimestamps();
    }
}
