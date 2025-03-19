<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = "users";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[    
        'name',    
        'password',
        'email',
        'role',
    'direccion',
    'telefono',
        'perfil',
    ];

    protected $guarded=[

    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
