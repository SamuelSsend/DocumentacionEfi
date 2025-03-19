<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navegacion extends Model
{
    protected $table = "navegacion";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[    
        'titulo',    
        'icono',
        'enlace',

    ];

    protected $guarded=[

    ];
}
