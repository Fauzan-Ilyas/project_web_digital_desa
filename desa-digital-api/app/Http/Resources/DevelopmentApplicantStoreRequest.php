<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DevelopmentApplicantStoreRequest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'development_id' => 'required|exists:developments,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'nullable|in:pending,approved,rejected'
        ];
    }

    public function attributes(

    ){
        return [
            'development_id' => 'pembangunan',
            'user_id' => 'User',
            'status' => 'Status'
        ];
    }
}
