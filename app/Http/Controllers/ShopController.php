<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function storefront()
    {
        $featuredNew = Product::query()->where('featured_new', true)->where('stock', '>', 0)->get();
        $featuredTrending = Product::query()->where('featured_trending', true)->where('stock', '>', 0)->get();
        $featuredBestseller = Product::query()->where('featured_bestseller', true)->where('stock', '>', 0)->get();

        return view('shop.storefront', compact('featuredNew', 'featuredTrending', 'featuredBestseller'));
    }

    public function products()
    {
        $products = Product::query()->orderBy('name')->paginate(12);

        return view('shop.products', compact('products'));
    }
}
