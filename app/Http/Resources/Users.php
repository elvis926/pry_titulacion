<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Users extends JsonResource
{
    protected $token;

    public function __construct($resource, $token=null){
        parent::__construct($resource);
        $this->$token = $token;
    }
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
            'name' => $this->name,
            'email' => $this->email,
            'role'=> $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        
    }
}
