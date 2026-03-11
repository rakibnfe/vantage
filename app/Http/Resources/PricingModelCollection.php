<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PricingModelCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => PricingModelResource::collection($this->collection),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
    }
}