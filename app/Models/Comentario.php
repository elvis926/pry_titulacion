<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = ['text','user_id'];
    
    public static function boot()
    {
        parent::boot();
        static::creating(function ($comentario) {
            $comentario->user_id = Auth::id();
        });
    }

    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
