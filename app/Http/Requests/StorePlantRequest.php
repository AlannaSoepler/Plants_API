<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
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
            'name' => ['bail','required','unique:App\Models\Plant,name','max:15', 'min:3'],
            'breed' => ['required', 'max:50', 'min:3'],
            'image' => ['required', 'url'],
            'info' => ['required','max:255', 'min:5'],
            'season' => ['required',Rule::in(['spring', 'summer','autumn', 'winter'])],
            'hight' => ['required'],
            'likes' => ['required', 'integer'],
            'provider_id' => ['required', 'exists:providers,id'],
            'shops' => ['required', 'exists:shops,id']
        ];
    }
}
