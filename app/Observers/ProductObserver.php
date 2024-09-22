<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $product->slug = Str::slug($product->name) . '-' . uniqid();
        $product->save(); 
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('name')) {
            $product->slug = Str::slug($product->name) . '-' . uniqid();
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
}
