@extends('layouts.app')

@section('title', 'Profile — LSJV STORE')

@section('content')
    <h1 class="text-2xl font-bold text-stone-900">Your profile</h1>
    <p class="mt-2 text-stone-600">Account details used for delivery and contact.</p>

    <form action="{{ route('profile.update') }}" method="post" class="mt-8 max-w-xl space-y-4 rounded-xl border border-stone-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block text-sm font-medium text-stone-700">Complete name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-stone-700">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label for="address" class="block text-sm font-medium text-stone-700">Address</label>
            <textarea name="address" id="address" rows="3" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">{{ old('address', $user->address) }}</textarea>
        </div>
        <div>
            <label for="mobile_number" class="block text-sm font-medium text-stone-700">Mobile number</label>
            <input type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <button type="submit" class="rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800">Save changes</button>
    </form>
@endsection
