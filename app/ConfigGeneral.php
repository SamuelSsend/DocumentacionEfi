<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigGeneral extends Model
{
    protected $table = "config_general";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[
        'nombre_empresa',
        'logo',
        'cr',
        'ubicacion',
        'correo',
        'telefono1',
        'telefono2',
        'facebook',
        'instagram',
        'horarios',
        'categorias_menu',
        'color_texto_menu',
        'color_fondo_menu',
        'facebook_iframe',
        'culqi_private',
        'culqi_public',
        'carta'
    ];

    protected $guarded=[

    ];
}
