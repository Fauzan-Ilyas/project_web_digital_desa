<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialAssistanceResource extends JsonResource
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
            'thumbnail' =>asset('storage/' . $this->thumbnail),
            'name' => $this->name,
            'category' => $this->category,
            'amount' => $this->amount,
            'provider' => $this->provider,
            'description' => $this->description,
            'is_available' => $this->is_available,
            'social_assistance_recipients' => SocialAssistanceRecipientResource::collection($this->whenLoaded('socialAssistanceRecipients')),
            'recipients_count' => $this->socialAssistanceRecipients()->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
