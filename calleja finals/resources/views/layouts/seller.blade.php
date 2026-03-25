<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Seller — LSJV STORE')</title>
    @production
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endproduction
</head>
<body class="flex min-h-screen flex-col bg-slate-50 font-sans text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('seller.reports.index') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.svg') }}" width="44" height="44" alt="LSJV STORE logo" class="h-11 w-11">
                <span class="text-lg font-semibold tracking-tight text-emerald-900">LSJV STORE</span>
                <span class="rounded-full bg-slate-200 px-2 py-0.5 text-xs font-medium text-slate-700">Seller</span>
            </a>
            <nav class="flex flex-wrap items-center gap-2 text-sm font-medium">
                <a href="{{ route('seller.reports.index') }}" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100">Reports</a>
                <a href="{{ route('seller.storefront.edit') }}" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100">Storefront</a>
                <a href="{{ route('seller.inventory.index') }}" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100">Inventory</a>
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-slate-600 hover:bg-slate-100">View shop</a>
                <form action="{{ route('seller.logout') }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100">Log out</button>
                </form>
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
