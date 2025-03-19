<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTres extends Model
{
    protected $table = "seccion_tres";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[    
        'titulo',    
        'icono',
        'descripcion',
        'estado'
    ];

    protected $guarded=[

    ];
}
