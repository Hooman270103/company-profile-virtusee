<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:10', function ($attribute, $value, $fail) {
                if (request()->method() == 'POST') {
                    $category = \App\Models\GalleryCategory::where('name', $value)->first();
                    if ($category) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                } elseif (request()->method() == 'PUT' || request()->method() == 'PATCH') {
                    $category = \App\Models\GalleryCategory::where('name', $value)->where('id', '!=', request()->route('gallery_category'))->first();
                    if ($category) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }
            }],
            'menus' => ['required', 'array'],
            'menus.*' => ['required'],
            'posting' => ['required'],
            'status' => ['required'],
        ];
    }
}
