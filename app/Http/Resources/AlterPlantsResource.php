<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlterPlantsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shops = array();
        foreach ($this->shops as $shop){
           array_push($shops, $shop->name);
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'breed' => $this->breed,
            'image' => $this->image,
            'info' => $this->info,
            'season' => $this->season,
            'hight' => $this->hight,
            'likes' => $this->likes,
            'provider_id' => $this->provider->id,
            //when loading plant resource. Take the JSON structure from the shop resource and display as well. 
            //'shops_all' => AlterShopResource::collection($this->whenLoaded('shops')),
            'shops'=> $shops
        ];
    }
}
