<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProcessStepCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ProcessStepResource::collection($this->collection),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
    }
}