<?php

namespace App\Http\Resources\Api\Lead;

use Illuminate\Http\Request;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Traits\ResponseStatusCodeTrait;

class LeadResource extends JsonResource
{
    use ResponseStatusCodeTrait;
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
            'email' => $this->email,
            'status' => $this->status,
            'owner' => $this->whenLoaded('owner', function(){
                return [
                'id' => $this->owner->id,
                'name' => $this->owner->name,
                'email' => $this->owner->email,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }


}
