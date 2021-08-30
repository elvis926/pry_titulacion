<?php

namespace App\Http\Resources;
use App\Models\User;
use App\Models\Solicitud;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Postulacions extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'estado' => $this->content,
            'tecnico_id' => '/api/users/' . $this->tecnico_id,
            'soliciud_id' => '/api/solicituds/' . $this->solicitud_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
