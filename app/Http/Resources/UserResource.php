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
        //The first user is open for everyone to see. So that you can test the api.
        //The rest of the users are invisible. 
        //Due to the fact that the passwords are encrypted i manually added the password  
        return [
            'name' => $this->when($this->id == 1, $this->name),
            'email' => $this->when($this->id == 1, $this->email),
            'password' => $this->when($this->id == 1, 'Hello13')
        ];
    }
}
