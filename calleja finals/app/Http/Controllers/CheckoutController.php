<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $items = $request->user()->cartItems()->with('product')->get();
        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        foreach ($items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')->with('error', 'Some items exceed available stock. Please update your cart.');
            }
        }
        $subtotal = $items->sum(fn ($i) => (float) $i->product->price * $i->quantity);

        return view('shop.checkout', compact('items', 'subtotal'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:cash_on_delivery,gcash,bank_transfer'],
            'fulfillment_type' => ['required', 'in:pickup,delivery'],
        ]);

        $user = $request->user();

        return DB::transaction(function () use ($user, $validated) {
            $items = $user->cartItems()->with('product')->get();
            if ($items->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }

            $total = 0;
            foreach ($items as $item) {
                $product = Product::query()->whereKey($item->product_id)->lockForUpdate()->first();
                if (! $product || $item->quantity > $product->stock) {
                    return redirect()->route('cart.index')->with('error', 'Stock changed for one or more items. Please review your cart.');
                }
                $total += (float) $product->price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'CC-'.strtoupper(bin2hex(random_bytes(4))).'-'.now()->format('His'),
                'payment_method' => $validated['payment_method'],
                'fulfillment_type' => $validated['fulfillment_type'],
                'total' => $total,
                'status' => 'completed',
            ]);

            foreach ($items as $item) {
                $product = Product::query()->whereKey($item->product_id)->lockForUpdate()->first();
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $product->price,
                ]);
                $product->decrement('stock', $item->quantity);
            }

            $user->cartItems()->delete();

            return redirect()->route('orders.index')->with('status', 'Order placed successfully.');
        });
    }
}
