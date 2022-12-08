<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
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

            return [
                'name' => ['bail','required','max:15', 'min:3'],
                'address' => ['required'],
                'info' => ['required', 'min:3','max:255']
            ];
        }
        
        //The patch request only requires the attributes that are requested to be updated.

        else{
            return [
                'name' => ['bail','sometimes','required','max:15', 'min:3'],
                'address' => ['sometimes','required'],
                'info' => ['sometimes','required', 'min:3','max:255']
            ];
        }
    }
}
