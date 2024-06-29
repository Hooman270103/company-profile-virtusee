<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CounterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:10'],
            'menus' => ['required', 'array'],
            'menus.*' => ['required'],
            'posting' => ['required'],
            'status' => ['required'],
            'title_data' => ['required', 'array'],
            'title_data.*' => ['required'],
            'number_data' => ['required', 'array'],
            'number_data.*' => ['required']
        ];
    }
}
