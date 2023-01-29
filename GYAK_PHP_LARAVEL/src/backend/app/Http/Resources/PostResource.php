<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'user' => $this->resource->user,
            'images' => $this->resource->images
         ]);
    }
}
