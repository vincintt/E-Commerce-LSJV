@extends('layouts.app')

@section('title', 'Checkout — LSJV STORE')

@section('content')
    <h1 class="text-2xl font-bold text-stone-900">Checkout</h1>
    <p class="mt-2 text-stone-600">Choose how you will pay and how you will receive your order.</p>

    <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <form action="{{ route('checkout.process') }}" method="post" class="space-y-6 rounded-xl border border-stone-200 bg-white p-6 shadow-sm">
            @csrf
            <fieldset>
                <legend class="text-sm font-semibold text-stone-800">Payment method</legend>
                <div class="mt-3 space-y-2">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="payment_method" value="cash_on_delivery" class="text-emerald-700" @checked(old('payment_method', 'cash_on_delivery') === 'cash_on_delivery') required>
                        Cash on delivery
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="payment_method" value="gcash" class="text-emerald-700" @checked(old('payment_method') === 'gcash')>
                        GCash
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="payment_method" value="bank_transfer" class="text-emerald-700" @checked(old('payment_method') === 'bank_transfer')>
                        Bank transfer
                    </label>
                </div>
            </fieldset>
            <fieldset>
                <legend class="text-sm font-semibold text-stone-800">Fulfillment</legend>
                <div class="mt-3 space-y-2">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="fulfillment_type" value="pickup" class="text-emerald-700" @checked(old('fulfillment_type', 'pickup') === 'pickup') required>
                        Pickup at LSJV STORE hub
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="fulfillment_type" value="delivery" class="text-emerald-700" @checked(old('fulfillment_type') === 'delivery')>
                        Delivery to your address on file
                    </label>
                </div>
            </fieldset>
            <button type="submit" class="w-full rounded-lg bg-emerald-700 py-3 font-semibold text-white hover:bg-emerald-800">Place order</button>
        </form>

        <div class="rounded-xl border border-stone-200 bg-stone-50 p-6">
            <h2 class="font-semibold text-stone-900">Order summary</h2>
            <ul class="mt-4 space-y-2 text-sm">
                @foreach ($items as $item)
                    <li class="flex justify-between">
                        <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                        <span>₱{{ number_format((float) $item->product->price * $item->quantity, 2) }}</span>
                    </li>
                @endforeach
            </ul>
            <p class="mt-4 border-t border-stone-200 pt-4 text-lg font-bold">Total: ₱{{ number_format($subtotal, 2) }}</p>
        </div>
    </div>
@endsection
