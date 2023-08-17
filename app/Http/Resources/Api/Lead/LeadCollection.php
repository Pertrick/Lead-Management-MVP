<?php

namespace App\Http\Resources\Api\Lead;

use Illuminate\Http\Request;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Api\Traits\ResponseStatusCodeTrait;

class LeadCollection extends ResourceCollection
{
    use ResponseStatusCodeTrait;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'owner' => UserResource::collection($this->whenLoaded('owner')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
