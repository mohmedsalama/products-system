<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price - ($this->discount ?? 0),
            'discount' => $this->discount,
            'stock' => $this->stock,

            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],

            'images' => $this->images->map(function ($image) {
                return asset('storage/' . $image->image);
            }),
        ];
    }
}