<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevelopmentApplicantUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'development_id' => 'required|exists:developments,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }

    public function attributes()
    {
        return [
            'development_id' => 'Pembangunan',
            'user_id' => 'Pengguna',
            'status' => 'Status',
        ];
    }
}
