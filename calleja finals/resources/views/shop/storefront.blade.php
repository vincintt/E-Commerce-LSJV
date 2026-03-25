@extends('layouts.app')

@section('title', 'Storefront — LSJV STORE')

@section('content')
    <h1 class="text-2xl font-bold text-stone-900">Storefront</h1>
    <p class="mt-2 text-stone-600">Curated sections for new, trending, and best-selling coir goods. Inventory updates as the seller adjusts the storefront.</p>

    <div class="mt-10 space-y-12">
        <section>
            <h2 class="border-b border-stone-200 pb-2 text-xl font-semibold text-stone-800">New</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($featuredNew as $product)
                    @include('partials.product-card', ['product' => $product])
                @empty
                    <p class="text-stone-500">No products in this section.</p>
                @endforelse
            </div>
        </section>
        <section>
            <h2 class="border-b border-stone-200 pb-2 text-xl font-semibold text-stone-800">Trending</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($featuredTrending as $product)
                    @include('partials.product-card', ['product' => $product])
                @empty
                    <p class="text-stone-500">No products in this section.</p>
                @endforelse
            </div>
        </section>
        <section>
            <h2 class="border-b border-stone-200 pb-2 text-xl font-semibold text-stone-800">Best sellers</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($featuredBestseller as $product)
                    @include('partials.product-card', ['product' => $product])
                @empty
                    <p class="text-stone-500">No products in this section.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
