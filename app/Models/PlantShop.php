<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantShop extends Model
{
    protected $table = 'plant_shop';
    
    use HasFactory;
    public function plants(){
        return $this->hasMany(Plant::class);
    }

    public function shops(){
        return $this->hasMany(Shop::class);
    }
    
}
