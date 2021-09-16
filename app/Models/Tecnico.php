<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $fillable = ['name','email','telefono','direccion','descripcion','estudios'];
    use HasFactory;
}
