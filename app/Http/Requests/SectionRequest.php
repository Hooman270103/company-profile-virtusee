<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'min:10'],
            'content' => ['required', 'string'],
            'menus' => ['required', 'array'],
            'menus.*' => ['required'],
            'posting' => ['required'],
            'status' => ['required'],
        ];

        if (Route::is('admin.section.store')) {
            $rules['image'] = ['required', 'mimes:jpeg,png,jpg', 'max:2048'];
        }
        else{
            $rules['image'] = ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'];
        }

        return $rules;
    }
}
