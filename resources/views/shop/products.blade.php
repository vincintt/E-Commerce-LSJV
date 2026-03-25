@extends('layouts.app')

@section('title', 'All products — LSJV STORE')

@section('content')
    <h1 class="text-2xl font-bold text-stone-900">All products</h1>
    <p class="mt-2 text-stone-600">Complete catalog of coir materials and finished goods from LSJV STORE</p>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($products as $product)
            <div id="p-{{ $product->id }}">
                @include('partials.product-card', ['product' => $product, 'showBadges' => true])
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endsection
