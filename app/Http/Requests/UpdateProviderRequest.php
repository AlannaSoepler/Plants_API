<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
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
            return [
                'name' => ['sometimes', 'required'],
                'info' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required'],
                'telephone' => ['sometimes', 'required']
            ];
        }
        
        else{
            return [
                'name' => ['sometimes', 'required'],
                'info' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required'],
                'telephone' => ['sometimes', 'required']
            ];
        }

    }
}
