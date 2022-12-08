<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
        return [
            'name' => ['bail','required','unique:App\Models\Provider,name','min:3','max:15'],
            'logo' => ['required', 'url'],
            'info' => ['required', 'min:3','max:255'],
            //checks if it is a valid email address and if it has been created previously. 
            'email' => ['required','unique:App\Models\Provider,email','email:rfc,dns'],
            'telephone' => ['required','unique:App\Models\Provider,telephone','digits:10']
            // If i want to make a new phone number i must exclude the symbol "-".  
        ];
    }
}
