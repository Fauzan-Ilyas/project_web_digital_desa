<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'password' => 'Kata Sandi'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa string.',
            'max' => ':attribute maximal :max karakter.',
            'min' => ':attribute minimal :min karakter',
        ];
    }
}
