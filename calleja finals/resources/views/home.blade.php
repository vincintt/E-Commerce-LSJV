@extends('layouts.app')

@section('title', 'Home — LSJV STORE')

@section('content')
    <section class="rounded-2xl bg-gradient-to-br from-emerald-900 via-emerald-800 to-amber-900 p-8 text-white shadow-lg md:p-12">
        <p class="text-sm font-medium uppercase tracking-widest text-emerald-200/90">Philippine coconut coir</p>
        <h1 class="mt-2 text-3xl font-bold leading-tight md:text-4xl">Natural coir fiber for homes, farms, and green building</h1>
        <p class="mt-4 max-w-2xl text-emerald-100/95">LSJV STORE offers ropes, mats, loose fiber, and craft bundles—eco-friendly alternatives sourced from coconut husks.</p>
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('shop.storefront') }}" class="rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-emerald-900 hover:bg-emerald-50">Browse storefront</a>
            <a href="{{ route('shop.products') }}" class="rounded-lg border border-white/40 px-5 py-2.5 text-sm font-semibold text-white hover:bg-white/10">All products</a>
        </div>
    </section>

    <section class="mt-12">
        <h2 class="text-xl font-bold text-stone-900">Featured on the storefront</h2>
        <p class="mt-1 text-stone-600">New arrivals, trending picks, and best sellers—<a href="{{ route('shop.storefront') }}" class="font-medium text-emerald-800 underline">see full storefront</a>.</p>

        <div class="mt-8 space-y-10">
            <div>
                <h3 class="text-lg font-semibold text-stone-800">New</h3>
                <div class="mt-4 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @forelse ($featuredNew as $product)
                        @include('partials.product-card', ['product' => $product])
                    @empty
                        <p class="text-stone-500">No new featured items yet.</p>
                    @endforelse
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-stone-800">Trending</h3>
                <div class="mt-4 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @forelse ($featuredTrending as $product)
                        @include('partials.product-card', ['product' => $product])
                    @empty
                        <p class="text-stone-500">No trending items yet.</p>
                    @endforelse
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-stone-800">Best sellers</h3>
                <div class="mt-4 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @forelse ($featuredBestseller as $product)
                        @include('partials.product-card', ['product' => $product])
                    @empty
                        <p class="text-stone-500">No best sellers yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
