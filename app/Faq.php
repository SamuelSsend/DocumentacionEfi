<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = "faq";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[    
        'pregunta',    
        'respuesta',
  
    ];

    protected $guarded=[

    ];
}
