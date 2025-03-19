<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subproducto extends Model
{
    protected $table = "subproductos";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $keyType = 'string';

    protected $guarded = [

    ];

    public function combinados()
    {
        return $this->belongsToMany(Combinado::class, 'combinado_subproducto')->withTimestamps();
    }
}
