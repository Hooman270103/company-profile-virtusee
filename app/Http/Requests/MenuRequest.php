<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'slug' => ['nullable', 'string', 'alpha_dash'],
            'status' => ['required', 'string'],
            'parent_id' => ['nullable', 'string'],
            'type' => ['required', 'string'],
        ];
    
        if ($this->input('type') == 2) {
            $rules['link_url'] = ['required', 'string', 'min:10'];
        }
    
        if (Route::is('admin.menu.store')) {
            $rules['position'] = ['required', 'unique:menus,position'];
        } else {
            // Assuming $this->menu is the menu model being updated
            $rules['position'] = ['required', 'unique:menus,position,' . $this->menu->id];
        }
    
        return $rules;
    }
}
