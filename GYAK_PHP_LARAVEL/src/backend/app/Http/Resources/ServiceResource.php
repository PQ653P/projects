<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_merge( parent::toArray($request), [
            'appointment' => $this->resource->appointment,
            'user' => $this->resource->user,
            'images'=> $this->resource->images
        ]);
    }
}
