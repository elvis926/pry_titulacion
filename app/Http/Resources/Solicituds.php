<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Solicituds extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'descripcionPC' => $this->descripcionPC,
            'fechaIni' => $this->fechaIni,
            'fechaFin' => $this->fechaFn,
            'dano' => $this->dano,
            'descripcion' => $this->descripcion,
            'cliente' => '/api/users/' . $this->cliente_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        
    }
}
