<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('name')->paginate(15);

        return view('seller.inventory.index', compact('products'));
    }

    public function create()
    {
        return view('seller.inventory.form', ['product' => new Product]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']).'-'.Str::lower(Str::random(4));

        Product::create($validated);

        return redirect()->route('seller.inventory.index')->with('status', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('seller.inventory.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validated($request);
        $product->update($validated);

        return redirect()->route('seller.inventory.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('seller.inventory.index')->with('status', 'Product removed.');
    }

    private function validated(Request $request): array
    {
        $v = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image_url' => ['required', 'url', 'max:500'],
        ]);
        $v['featured_new'] = $request->boolean('featured_new');
        $v['featured_trending'] = $request->boolean('featured_trending');
        $v['featured_bestseller'] = $request->boolean('featured_bestseller');

        return $v;
    }
}
