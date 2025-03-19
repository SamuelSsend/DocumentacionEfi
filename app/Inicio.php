<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inicio extends Model
{
    protected $table = "inicio";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[    
        'titulo_cabecera',    
        'titulo_principal',
        'precio',
        'titulo_producto',
        'foot_img_uno',
        'foot_img_dos',
        'foot_img_tres',
        'foot_img_cuatro',
    ];

    protected $guarded=[

    ];
}
