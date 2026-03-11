<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PricingModelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'starting_price' => $this->starting_price,
            'formatted_price' => $this->starting_price ? '$' . number_format($this->starting_price, 2) : null,
            'notes' => $this->notes,
            'order' => $this->order,
        ];
    }
}