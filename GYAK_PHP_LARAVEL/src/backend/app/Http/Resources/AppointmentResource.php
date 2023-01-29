<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_merge( parent::toArray($request), [
            'user' => $this->resource->user,
            'service' => $this->resource->service
            ]);
    }
}
