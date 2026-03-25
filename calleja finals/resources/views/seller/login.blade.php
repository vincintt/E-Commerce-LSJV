@extends('layouts.app')

@section('title', 'Seller log in — LSJV STORE')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-2xl font-bold text-stone-900">Seller portal</h1>
        <p class="mt-2 text-sm text-stone-600">Manage storefront highlights, inventory, and sales reports. Customers can <a href="{{ route('login') }}" class="font-medium text-emerald-800 underline">log in here</a>.</p>

        <form action="{{ route('seller.login') }}" method="post" class="mt-8 space-y-4 rounded-xl border border-stone-200 bg-white p-6 shadow-sm">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-stone-700">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-stone-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <label class="flex items-center gap-2 text-sm text-stone-600">
                <input type="checkbox" name="remember" value="1" class="rounded border-stone-300 text-emerald-700">
                Remember me
            </label>
            <button type="submit" class="w-full rounded-lg bg-slate-800 py-2.5 text-sm font-semibold text-white hover:bg-slate-900">Seller log in</button>
        </form>
    </div>
@endsection
