<?php

namespace App\Models;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo', 'info', 'email', 'telephone'];
    // protected $guarded = [];

    public function plants(){
        return $this->hasMany(Plant::class);
    }
}
