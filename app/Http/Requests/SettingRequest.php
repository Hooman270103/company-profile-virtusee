<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        if ($this->input('type') == 'general') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'tagline' => ['nullable'],
                'description' => ['required', 'string'],
                'no_telp' => ['nullable', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15'],
                'address' => ['required', 'string'],
                'maps_location' => ['nullable'],
                'email' => ['required','email']
            ];
        }
        else if ($this->input('type') == 'logo') {
            return [
                'logo_primary' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'],
                'logo_secondary' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'],
                'favicon' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'],
            ];
        }
        else if ($this->input('type') == 'social') {
            return [
                'link_instagram' => ['nullable', 'string'],
                'link_facebook' => ['nullable', 'string'],
                'link_twitter' => ['nullable', 'string'],
                'link_tiktok' => ['nullable', 'string'],
                'link_linkedin' => ['nullable', 'string'],
            ];
        }
        else if ($this->input('type') == 'mail_setting') {
            return [
                'mail_mailer' => ['required', 'string'],
                'mail_host' => ['required', 'string'],
                'mail_port' => ['required', 'string'],
                'mail_username' => ['required', 'string'],
                'mail_password' => ['required', 'string'],
                'mail_encryption' => ['required', 'string'],
                'mail_from_addres' => ['required', 'string'],
                'mail_from_name' => ['required', 'string'],
            ];
        }
        else if ($this->input('type') == 'warna') {
            return [
                'color_primary' => ['required', 'string'],
                'color_secondary' => ['required', 'string'],
            ];
        }
    }
}
