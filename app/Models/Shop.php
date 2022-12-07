<?php

namespace App\Models;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = [''];

    //is being called in the shop seeder. 
    public function plants(){
        return $this->belongsToMany(Plant::class)->withTimestamps();
    }

    public function plantShop(){
        return $this->belongsTo(PlantShop::class)->withTimestamps();
    }
}
