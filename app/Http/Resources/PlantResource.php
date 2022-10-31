<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'breed' => $this->breed,
            'image' => $this->image,
            'info' => $this->info,
            'season' => $this->season,
            'hight' => $this->hight,
            'provider' => $this->provider,
            'likes' => $this->likes,
        ];
    }
}
