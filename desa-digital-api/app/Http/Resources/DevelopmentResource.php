<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DevelopmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thumbnail' => $this->thumbnail,
            'name' => $this->name,
            'description' => $this->description,
            'person_in_change' => $this->person_in_change,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'amount' => $this->amount,
            'status' => $this->status,
        ];
    }
}
