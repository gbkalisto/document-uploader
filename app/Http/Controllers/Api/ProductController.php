<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Services\ProductService;

class ProductController extends Controller
{

    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Cache::remember("products_{$request->page}", now()->addMinutes(60), function () {
            //Log::info("Fetching from Database!");
            return Product::latest()->paginate(10);
        });

        return ProductResource::collection($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $fields = $request->validated();
        $product = $this->productService->createProduct($fields);
        return response()->json(['message' => 'Product created successfull', 'product' => new ProductResource($product)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $updatedProduct = $this->productService->updateProduct($product, $request->validated());

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => new ProductResource($updatedProduct)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Cache::flush(); // Clear cache to ensure deleted product is removed from listing
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
