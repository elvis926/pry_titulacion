<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_ADMINTECNICO = 'ROLE_ADMINTECNICO';
    const ROLE_CLIENTE = 'ROLE_CLIENTE';
    const ROLE_TECNICO = 'ROLE_TECNICO';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function comentarios()
    {
        return $this->hasMany('App\Model\Comentario');
    }

    public function solicitudes()
    {
        return $this->hasMany('App\Model\Solicitud');
    }

    public function postulaciones()
    {
        return $this->hasMany('App\Model\Postulacion');
    }
}
