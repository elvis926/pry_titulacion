<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = ['descripcionPC','fechaIni','fechaFin','dano','descripcion','estado'];
    
    public static function boot()
    {
        parent::boot();
        static::creating(function ($solicitud) {
            $solicitud->cliente_id = Auth::id();
        });
    }

    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function postulacion()
    {
        return $this->hasMany('App\Model\Postulacion');
    }
}