<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'short_description' => 'required|string',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048', // Max 2MB image
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ];
    }
}
