<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * This resource is used to structure the JSON data that will be returned to the user when they send a request to the API
     * I can exclude information which the users will not able to see. Like: id, when it was created and updated. 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            // 'id' => $this->id,
            'name' => $this->name,
            'breed' => $this->breed,
            'image' => $this->image,
            'info' => $this->info,
            'season' => $this->season,
            'hight' => $this->hight,
            'provider_id' => $this->provider->name,
            'likes' => $this->likes,
        ];
    }
}
