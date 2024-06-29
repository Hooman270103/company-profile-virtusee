<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoSlidersRequest extends FormRequest
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
            'image' => ['required', 'array'],
            'image.*' => ['required']
        ];
    }
}