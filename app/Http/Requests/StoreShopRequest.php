<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
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
            'name' => ['bail','required','unique:App\Models\Shop,name','max:15', 'min:3'],
            'address' => ['required','unique:App\Models\Shop,address'],
            'info' => ['required', 'min:3','max:255'],
            'plants' => ['required', 'exists:plants,id']
        ];
    }
}
