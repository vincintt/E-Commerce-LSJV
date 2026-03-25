<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function edit()
    {
        $products = Product::query()->orderBy('name')->get();

        return view('seller.storefront', compact('products'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'featured_new' => ['array'],
            'featured_new.*' => ['integer', 'exists:products,id'],
            'featured_trending' => ['array'],
            'featured_trending.*' => ['integer', 'exists:products,id'],
            'featured_bestseller' => ['array'],
            'featured_bestseller.*' => ['integer', 'exists:products,id'],
        ]);

        Product::query()->update([
            'featured_new' => false,
            'featured_trending' => false,
            'featured_bestseller' => false,
        ]);

        $newIds = $data['featured_new'] ?? [];
        $trendIds = $data['featured_trending'] ?? [];
        $bestIds = $data['featured_bestseller'] ?? [];

        if ($newIds !== []) {
            Product::query()->whereIn('id', $newIds)->update(['featured_new' => true]);
        }
        if ($trendIds !== []) {
            Product::query()->whereIn('id', $trendIds)->update(['featured_trending' => true]);
        }
        if ($bestIds !== []) {
            Product::query()->whereIn('id', $bestIds)->update(['featured_bestseller' => true]);
        }

        return back()->with('status', 'Storefront featured sections updated.');
    }
}
