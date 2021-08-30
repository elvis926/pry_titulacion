<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Comments extends ResourceCollection
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
            'text' => $this->text,
            'user'=> '/api/users/' . $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
        ];
    }
}
