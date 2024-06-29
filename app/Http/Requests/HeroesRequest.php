<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:10'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
