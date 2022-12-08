<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $plants = array();
        foreach ($this->plants as $plant){
           array_push($plants, $plant->name);
        }
        return [
            'name' => $this->name,
            'address' => $this->address,
            'info' => $this->info,
            'plants' => $plants
        ];
    }
}
