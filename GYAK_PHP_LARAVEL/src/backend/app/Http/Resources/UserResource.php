<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_merge( parent::toArray($request), [
            'appointments' => $this->resource->appointments,
            'images' => $this->resource->images,
        ]);
    }
}
