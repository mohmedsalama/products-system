<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
  use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function createProduct(array $data): Product
    {
        return DB::transaction(function () use ($data) {

            $images = $data['images'];
            unset($data['images']);

            $product = Product::create($data);

            foreach ($images as $image) {

                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image' => $path,
                ]);
            }

            return $product;
        });
    }

  

public function updateProduct(Product $product, array $data): Product
{
    return DB::transaction(function () use ($product, $data) {

        if (isset($data['images'])) {

            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image);
            }

            $product->images()->delete();

            $images = $data['images'];
            unset($data['images']);

            foreach ($images as $image) {

                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image' => $path,
                ]);
            }
        }

        $product->update($data);

        return $product->load('images');
    });
}

public function deleteProduct(Product $product): void
{
    DB::transaction(function () use ($product) {

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $product->images()->delete();

        $product->delete();
    });
}
}