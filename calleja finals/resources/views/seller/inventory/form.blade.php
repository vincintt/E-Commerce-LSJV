@extends('layouts.seller')

@php
    $editing = $product->exists;
@endphp

@section('title', ($editing ? 'Edit' : 'Add').' product — Seller')

@section('content')
    <h1 class="text-2xl font-bold text-slate-900">{{ $editing ? 'Edit product' : 'New product' }}</h1>
    <p class="mt-2 text-slate-600">Image URL should point to a real product photo (e.g. Wikimedia Commons or your own hosted file).</p>

    <form action="{{ $editing ? route('seller.inventory.update', $product) : route('seller.inventory.store') }}" method="post" class="mt-8 max-w-2xl space-y-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @if ($editing)
            @method('PUT')
        @endif
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="price" class="block text-sm font-medium text-slate-700">Price (₱)</label>
                <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $product->price) }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-slate-700">Stock</label>
                <input type="number" min="0" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>
        </div>
        <div>
            <label for="image_url" class="block text-sm font-medium text-slate-700">Image URL</label>
            <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $product->image_url) }}" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" placeholder="https://...">
        </div>
        <fieldset class="space-y-2">
            <legend class="text-sm font-medium text-slate-700">Storefront badges</legend>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="featured_new" value="1" class="rounded border-slate-300 text-emerald-700" @checked(old('featured_new', $product->featured_new))>
                New
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="featured_trending" value="1" class="rounded border-slate-300 text-emerald-700" @checked(old('featured_trending', $product->featured_trending))>
                Trending
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="featured_bestseller" value="1" class="rounded border-slate-300 text-emerald-700" @checked(old('featured_bestseller', $product->featured_bestseller))>
                Best seller
            </label>
        </fieldset>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800">{{ $editing ? 'Update' : 'Create' }}</button>
            <a href="{{ route('seller.inventory.index') }}" class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</a>
        </div>
    </form>
@endsection
