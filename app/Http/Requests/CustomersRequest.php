<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomersRequest extends FormRequest
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
            'name' => ['required','string', 'max:255'],
            'phone' => ['required','string', 'max:15', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['nullable','string', 'max:255'],
            'company_name' => ['required','string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'company_phone' => ['required', 'string', 'max:15', 'min:6'],
            'province_id' => ['required', 'string', 'max:255'],
            'regency_id' => ['required', 'string', 'max:255'],
            'district_id' => ['nullable', 'string', 'max:255'],
            'village_id' => ['nullable', 'string', 'max:255'],
            'company_address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'schedule' => ['required', 'string', 'max:255'],
            'marketing_contact' => ['required'],
            'know_where' => ['required'],
            'gender' => ['required'],
        ];
    }
}
