@extends('layouts.app')

@section('title', 'Register — LSJV STORE')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-2xl font-bold text-stone-900">Create your account</h1>
        <p class="mt-2 text-sm text-stone-600">Already registered? <a href="{{ route('login') }}" class="font-medium text-emerald-800 underline">Log in</a>.</p>

        <form action="{{ route('register') }}" method="post" class="mt-8 space-y-4 rounded-xl border border-stone-200 bg-white p-6 shadow-sm">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-stone-700">E-mail address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-stone-700">Password</label>
                <input type="password" name="password" id="password" required autocomplete="new-password" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-stone-700">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-stone-700">Complete name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-stone-700">Address</label>
                <textarea name="address" id="address" rows="3" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">{{ old('address') }}</textarea>
            </div>
            <div>
                <label for="mobile_number" class="block text-sm font-medium text-stone-700">Mobile number</label>
                <input type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            </div>
            <button type="submit" class="w-full rounded-lg bg-emerald-700 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800">Register</button>
        </form>
    </div>
@endsection
