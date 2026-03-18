<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{

    /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product): void
    {
        // Generate slug before the record is inserted
        $product->slug = $product->generateUniqueSlug($product->name);
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updating" event.
     */
    public function updating(Product $product): void
    {
        // Only regenerate the slug if the name has changed
        if ($product->isDirty('name')) {
            $product->slug = $product->generateUniqueSlug($product->name);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleting" event.
     */
    public function deleting(Product $product): void
    {
        if ($product->image) {
            // Check if file exists and delete it
            if (Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        }
    }
}
