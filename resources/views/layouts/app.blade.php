<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LSJV STORE')</title>
    @production
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endproduction
</head>
<body class="flex min-h-screen flex-col bg-stone-50 font-sans text-stone-900 antialiased">
    <header class="border-b border-stone-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.svg') }}" width="44" height="44" alt="LSJV STORE logo" class="h-11 w-11">
                <span class="text-lg font-semibold tracking-tight text-emerald-900">LSJV STORE</span>
            </a>
            <nav class="flex flex-wrap items-center gap-2 text-sm font-medium">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Home</a>
                <a href="{{ route('shop.storefront') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Storefront</a>
                <a href="{{ route('shop.products') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Products</a>
                @auth
                    @if (auth()->user()->isBuyer())
                        <a href="{{ route('cart.index') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Cart</a>
                        <a href="{{ route('checkout.show') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Checkout</a>
                        <a href="{{ route('orders.index') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Transactions</a>
                        <a href="{{ route('profile.show') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Profile</a>
                        <form action="{{ route('logout') }}" method="post" class="inline">
                            @csrf
                            <button type="submit" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Log out</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 text-stone-700 hover:bg-stone-100">Log in</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-emerald-700 px-3 py-2 text-white hover:bg-emerald-800">Register</a>
                @endauth
                <a href="{{ route('seller.login') }}" class="rounded-lg border border-stone-300 px-3 py-2 text-stone-600 hover:bg-stone-50">Seller</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8">
        @include('partials.flash')
        @yield('content')
    </main>

    @include('partials.footer-disclaimer')
</body>
</html>
