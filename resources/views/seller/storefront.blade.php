@extends('layouts.seller')

@section('title', 'Storefront — Seller')

@section('content')
    <h1 class="text-2xl font-bold text-slate-900">Modify storefront</h1>
    <p class="mt-2 text-slate-600">Choose which catalog items appear under <strong>New</strong>, <strong>Trending</strong>, and <strong>Best seller</strong> on the customer storefront. Only in-stock items are shown to buyers.</p>

    <form action="{{ route('seller.storefront.update') }}" method="post" class="mt-8 space-y-10">
        @csrf
        @method('PUT')

        @foreach (['featured_new' => 'New', 'featured_trending' => 'Trending', 'featured_bestseller' => 'Best seller'] as $field => $label)
            <fieldset class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <legend class="text-lg font-semibold text-slate-800">{{ $label }}</legend>
                <p class="mt-1 text-sm text-slate-500">Select one or more products (checkboxes).</p>
                <ul class="mt-4 max-h-64 space-y-2 overflow-y-auto text-sm">
                    @foreach ($products as $product)
                        <li class="flex items-start gap-3 rounded-lg border border-slate-100 p-2 hover:bg-slate-50">
                            <input type="checkbox" name="{{ $field }}[]" value="{{ $product->id }}" id="{{ $field }}_{{ $product->id }}" class="mt-1 rounded border-slate-300 text-emerald-700" @checked(is_array(old($field)) ? in_array($product->id, old($field, []), false) : (bool) $product->{$field})>
                            <label for="{{ $field }}_{{ $product->id }}" class="flex flex-1 cursor-pointer gap-3">
                                <img src="{{ $product->image_url }}" alt="" class="h-12 w-16 rounded object-cover" width="64" height="48">
                                <span>
                                    <span class="font-medium text-slate-900">{{ $product->name }}</span>
                                    <span class="block text-xs text-slate-500">Stock: {{ $product->stock }} · ₱{{ number_format($product->price, 2) }}</span>
                                </span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </fieldset>
        @endforeach

        <button type="submit" class="rounded-lg bg-emerald-700 px-6 py-3 font-semibold text-white hover:bg-emerald-800">Save storefront</button>
    </form>
@endsection
