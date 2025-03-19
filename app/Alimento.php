<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    protected $table = "alimento";
    protected $primaryKey = "id";
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $guarded = [

    ];

    public function combinados()
    {
        return $this->belongsToMany(Combinado::class, 'alimento_combinado');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getDescripcionAttribute()
    {
        return $this->attributes['descripcion_hosteltactil'] ?: $this->attributes['descripcion_manual'];
    }

    public function getEstaActivoAttribute()
    {
        return $this->attributes['estado'] == 'Disponible' and $this->attributes['activo_hosteltactil'];
    }

}
