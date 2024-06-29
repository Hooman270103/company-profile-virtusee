<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class TestimoniRequest extends FormRequest
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
        $rules =  [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published' => ['required', 'string'],
            'status' => ['required', 'string'],
            'menus.*' => ['required'],
        ];
        if (Route::is('admin.testimoni.store')) {
            $rules['image'] = ['required', 'mimes:jpeg,png,jpg', 'max:2048'];
        } else {
            $rules['image'] = ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'];
        }

        return $rules;
    }
}
