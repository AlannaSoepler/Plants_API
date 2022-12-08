<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();

        if($method == 'PUT'){
        
        //The reason behind setting all the attributes to required here, for the put request, is because 
        //PUT requires all the attributes to be present. Even if the attributes are the same. They will be 
        //over written anyhow. 

        //The error messages that are received can be confusing. 
        //Eks: if the name of the plant is already less than the min value and you do not update it 
        //The error will be that the put request is not supported. 

        // Here i can't use the eks: unique:App\Models\Provider,email because it technically already exists (Explain in video.)
        return [
            'name' => ['bail','required', 'min:3', 'max:5'],
            'breed' => ['required', 'max:50', 'min:3'],
            'image' => ['required', 'url'],
            'info' => ['required','max:255', 'min:5'],
            'season' => ['required',Rule::in(['spring', 'summer','autumn', 'winter'])],
            'hight' => ['required'],
            'likes' => ['required', 'integer'],
            'provider_id' => ['required', 'exists:providers,id']
        ];
    }

        //The patch request only requires the attributes that are requested to be updated. 
    
        else{
        return [
            'name' => ['bail','sometimes','required', 'min:3', 'max:5'],
            'breed' => ['sometimes','required', 'max:50', 'min:3'],
            'image' => ['sometimes','required', 'url'],
            'info' => ['sometimes','required','max:255', 'min:5'],
            'season' => ['sometimes','required',Rule::in(['spring', 'summer','autumn', 'winter'])],
            'hight' => ['sometimes','required'],
            'likes' => ['sometimes','required', 'integer'],
            'provider_id' => ['sometimes','required', 'exists:providers,id']
        ];
    }
    }
}
