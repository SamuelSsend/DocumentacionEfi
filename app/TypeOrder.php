<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOrder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
    ];
}
