<?php

namespace App\Models;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plant extends Model
{
    /**
     * When building APIs using Laravel, you will often need to convert your models and relationships to arrays or JSON. 
     * Eloquent includes convenient methods for making these conversions, as well as controlling which attributes are 
     * included in the serialized representation of your models.
     * 
     * All eloquent models are protected against mass assignment vulnerabilities 
     * The the model class, here, i can make models attributes accessible and editable for users by using the fillable array . 
     * if there are attributes i want to prevent users to change and access i will use the guarded array. 
     * On the other hand i can create an empty graded array. This means the same as if i had added all the attributes in the fillable array.    
     */
    use HasFactory;

    protected $fillable = ['name', 'breed', 'image', 'info', 'hight', 'likes', 'provider_id'];

    /**Adds the relationship to the table */
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
}
