@props(['product', 'showBadges' => true])

<article class="flex flex-col overflow-hidden rounded-xl border border-stone-200 bg-white shadow-sm transition hover:shadow-md">
    <a href="{{ route('shop.products') }}#p-{{ $product->id }}" class="block aspect-[4/3] overflow-hidden bg-stone-100">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover" loading="lazy" width="400" height="300">
    </a>
    <div class="flex flex-1 flex-col p-4">
        @if ($showBadges && ($product->featured_new || $product->featured_trending || $product->featured_bestseller))
            <div class="mb-2 flex flex-wrap gap-1">
                @if ($product->featured_new)
                    <span class="rounded-full bg-sky-100 px-2 py-0.5 text-xs font-medium text-sky-800">New</span>
                @endif
                @if ($product->featured_trending)
                    <span class="rounded-full bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-900">Trending</span>
                @endif
                @if ($product->featured_bestseller)
                    <span class="rounded-full bg-rose-100 px-2 py-0.5 text-xs font-medium text-rose-900">Best seller</span>
                @endif
            </div>
        @endif
        <h3 class="font-semibold text-stone-900">{{ $product->name }}</h3>
        <p class="mt-1 line-clamp-2 flex-1 text-sm text-stone-600">{{ $product->description }}</p>
        <p class="mt-3 text-lg font-bold text-emerald-800">₱{{ number_format($product->price, 2) }}</p>
        <p class="text-xs text-stone-500">{{ $product->stock > 0 ? $product->stock.' in stock' : 'Out of stock' }}</p>
        @auth
            @if (auth()->user()->isBuyer())
                @if ($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="post" class="mt-3">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full rounded-lg bg-emerald-700 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-800">Add to cart</button>
                    </form>
                @endif
            @endif
        @else
            <a href="{{ route('login') }}" class="mt-3 block w-full rounded-lg border border-stone-300 px-3 py-2 text-center text-sm font-medium text-stone-800 hover:bg-stone-50">Sign in to buy</a>
        @endauth
    </div>
</article>
