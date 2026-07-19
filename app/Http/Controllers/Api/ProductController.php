<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;


class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index()
    {
        $products = Product::query()
            ->with('images')
            ->latest()
            ->paginate(6);

        return response()->json([
            'status_code' => 200,
            'message' => 'Products retrieved successfully',
            'data' => ProductResource::collection($products),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService
            ->createProduct($request->validated());

        return response()->json([
            'status_code' => 201,
            'message' => 'Product created successfully',
            'data' => new ProductResource(
                $product->load('images')
            )
        ], 201);
    }



    public function update(UpdateProductRequest $request, Product $product)
{
    $product = $this->productService
        ->updateProduct($product, $request->validated());

    return response()->json([
        'status_code' => 200,
        'message' => 'Product updated successfully',
        'data' => new ProductResource($product),
    ]);
}

public function destroy(Product $product)
{
    $this->productService->deleteProduct($product);

    return response()->json([
        'status_code' => 200,
        'message' => 'Product deleted successfully',
    ]);
}
}
