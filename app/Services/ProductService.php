<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getProducts()
    {
        return Product::latest()->paginate(10);
    }

    public function createProduct(array $data): Product
    {
        // using observer product slug generate in background

        // 1. Handle the 'is_active' toggle (defaults to 0 if not present)
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        // 2. Handle Image Upload
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $image = $data['image'];
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('products', $imageName, 'public');
            $data['image'] = 'products/' . $imageName;
        }

        // 3. Create Product
        $product = Product::create($data);

        // 4. Clear Cache
        Cache::flush();

        return $product;
    }

    public function editProduct($id)
    {
        return Product::findOrFail($id);
    }


    /**
     * Handle the logic for updating an existing product.
     */
    public function updateProduct(Product $product, array $data): Product
    {
        // using observer product slug generate in background

        // 1. Handle the 'is_active' toggle (Manual check for checkboxes)
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        // 2. Handle Image Update
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {

            // Delete old image file from storage if it exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Store new image
            $image = $data['image'];
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');

            $data['image'] = 'products/' . $imageName;
        }
        // 3. Update the database record
        $product->update($data);

        // 4. Maintenance
        Cache::flush();

        return $product;
    }

    public function deleteProduct($id)
    {
        // using product observer image automactic unlnks
        $product = Product::findOrFail($id);
        return $product->delete();
    }


    public function importProducts($file)
    {
        // Use the exact path you just verified in terminal
        $filePath = '/mnt/e/example-app/storage/app/public/imports/test.xlsx';

        if (!file_exists($filePath)) {
            return "File not found at: " . $filePath;
        }

        Excel::queueImport(new ProductsImport, $filePath);

        return "Import queued for: " . $filePath;
        // Excel::queueImport(new ProductsImport, $file);
        return true;
    }
}
