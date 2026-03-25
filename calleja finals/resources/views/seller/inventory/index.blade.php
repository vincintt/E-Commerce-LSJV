@extends('layouts.seller')

@section('title', 'Inventory — Seller')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Inventory</h1>
            <p class="mt-1 text-slate-600">Add, edit, or remove products in the catalog.</p>
        </div>
        <a href="{{ route('seller.inventory.create') }}" class="rounded-lg bg-emerald-700 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-800">Add product</a>
    </div>

    <div class="mt-8 overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="px-4 py-3 font-semibold">Product</th>
                    <th class="px-4 py-3 font-semibold">Price</th>
                    <th class="px-4 py-3 font-semibold">Stock</th>
                    <th class="px-4 py-3 font-semibold">Flags</th>
                    <th class="px-4 py-3 font-semibold"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($products as $product)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->image_url }}" alt="" class="h-10 w-14 rounded object-cover">
                                <span class="font-medium text-slate-900">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">₱{{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3 text-xs text-slate-600">
                            @if ($product->featured_new) <span class="mr-1 rounded bg-sky-100 px-1.5 py-0.5">New</span> @endif
                            @if ($product->featured_trending) <span class="mr-1 rounded bg-amber-100 px-1.5 py-0.5">Trend</span> @endif
                            @if ($product->featured_bestseller) <span class="rounded bg-rose-100 px-1.5 py-0.5">Best</span> @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('seller.inventory.edit', $product) }}" class="text-emerald-800 underline">Edit</a>
                            <form action="{{ route('seller.inventory.destroy', $product) }}" method="post" class="inline" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 text-red-700 underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $products->links() }}</div>
@endsection
