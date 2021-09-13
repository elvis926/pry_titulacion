<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $fillable = ['estado','solicitud_id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($postulacion) {
            $postulacion->tecnico_id = Auth::id();
        });
    }

    public function users(){
        return $this->belongsTo('App\Model\User');
    }

    public function solicitud(){
        return $this->belongsTo('App\Model\Solicitud');
    }
}
