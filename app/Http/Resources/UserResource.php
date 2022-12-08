<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //The first user is open for everyone to see. So that you can test the api
        return [
            'name' => $this->when($this->id == 1, $this->name),
            'email' => $this->when($this->id == 1, $this->email),
            'password' => $this->when($this->id == 1, $this->password)
        ];
    }
}
