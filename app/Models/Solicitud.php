<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = ['descripcionPC','fechaIni','fechaFin','dano','descripcion'];
    use HasFactory;
}