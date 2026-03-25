@extends('layouts.app')

@section('title', 'Cart — LSJV STORE')

@section('content')
    <h1 class="text-2xl font-bold text-stone-900">Shopping cart</h1>

    @if ($items->isEmpty())
        <p class="mt-6 text-stone-600">Your cart is empty. <a href="{{ route('shop.products') }}" class="font-medium text-emerald-800 underline">Browse products</a>.</p>
    @else
        <ul class="mt-8 divide-y divide-stone-200 rounded-xl border border-stone-200 bg-white">
            @foreach ($items as $item)
                <li class="flex flex-col gap-4 p-4 sm:flex-row sm:items-center">
                    <img src="{{ $item->product->image_url }}" alt="" class="h-24 w-32 rounded-lg object-cover" width="128" height="96">
                    <div class="flex-1">
                        <h2 class="font-semibold">{{ $item->product->name }}</h2>
                        <p class="text-sm text-stone-600">₱{{ number_format($item->product->price, 2) }} each</p>
                    </div>
                    <form action="{{ route('cart.update', $item) }}" method="post" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <label class="text-sm text-stone-600">Qty</label>
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-20 rounded border border-stone-300 px-2 py-1 text-sm">
                        <button type="submit" class="rounded-lg bg-stone-200 px-3 py-1 text-sm font-medium hover:bg-stone-300">Update</button>
                    </form>
                    <p class="font-semibold text-emerald-800">₱{{ number_format((float) $item->product->price * $item->quantity, 2) }}</p>
                    <form action="{{ route('cart.remove', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-700 underline">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
            <p class="text-lg font-bold">Subtotal: <span class="text-emerald-800">₱{{ number_format($subtotal, 2) }}</span></p>
            <a href="{{ route('checkout.show') }}" class="rounded-lg bg-emerald-700 px-6 py-3 font-semibold text-white hover:bg-emerald-800">Proceed to checkout</a>
        </div>
    @endif
@endsection
