<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->user()->cartItems()->with('product')->get();
        $subtotal = $items->sum(fn (CartItem $i) => (float) $i->product->price * $i->quantity);

        return view('shop.cart', compact('items', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        if ($product->stock < 1) {
            return back()->with('error', 'This product is out of stock.');
        }

        $item = CartItem::query()->firstOrNew([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);
        $newQty = ($item->exists ? $item->quantity : 0) + max(1, (int) $request->input('quantity', 1));
        if ($newQty > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }
        $item->quantity = $newQty;
        $item->save();

        return redirect()->route('cart.index')->with('status', 'Added to cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== $request->user()->id) {
            abort(403);
        }
        $request->validate(['quantity' => ['required', 'integer', 'min:1']]);
        $max = $cartItem->product->stock;
        $cartItem->update(['quantity' => min((int) $request->quantity, $max)]);

        return back()->with('status', 'Cart updated.');
    }

    public function remove(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== $request->user()->id) {
            abort(403);
        }
        $cartItem->delete();

        return back()->with('status', 'Item removed.');
    }
}
