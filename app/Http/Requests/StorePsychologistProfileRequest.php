<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePsychologistProfileRequest extends FormRequest
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
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string|max:2000',
            'str_number' => 'required|string|max:50|unique:psychologist_profiles,str_number,' . ($this->route('profile') ?? 'NULL'),
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'specialization.required' => 'Spesialisasi harus diisi.',
            'str_number.required' => 'Nomor STR harus diisi.',
            'str_number.unique' => 'Nomor STR sudah terdaftar.',
        ];
    }
}
