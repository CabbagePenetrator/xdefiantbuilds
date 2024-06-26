<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoadoutResource extends JsonResource
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
            'name' => $this->name,
            'votes' => $this->votes,
            'user' => new UserResource($this->whenLoaded('user')),
            'gun' => new GunResource($this->whenLoaded('gun')),
        ];
    }
}
