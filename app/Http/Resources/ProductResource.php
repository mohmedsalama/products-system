<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'price' => $this->price - ($this->discount ?? 0),
            'discount' => $this->discount,
            'image' => $this->images->first()
                ? asset('storage/' . $this->images->first()->image)
                : null,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}