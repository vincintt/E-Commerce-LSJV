@extends('layouts.app')

@section('title', 'Transaction history — LSJV STORE')

@section('content')
    <h1 class="text-2xl font-bold text-stone-900">Transaction history</h1>
    <p class="mt-2 text-stone-600">Past orders placed with LSJV STORE</p>

    @if ($orders->isEmpty())
        <p class="mt-8 text-stone-600">You have not placed any orders yet.</p>
    @else
        <div class="mt-8 space-y-6">
            @foreach ($orders as $order)
                <article class="overflow-hidden rounded-xl border border-stone-200 bg-white shadow-sm">
                    <div class="flex flex-wrap items-center justify-between gap-2 border-b border-stone-100 bg-stone-50 px-4 py-3">
                        <div>
                            <p class="font-mono text-sm font-semibold text-stone-900">{{ $order->order_number }}</p>
                            <p class="text-xs text-stone-500">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                        </div>
                        <p class="text-lg font-bold text-emerald-800">₱{{ number_format($order->total, 2) }}</p>
                    </div>
                    <div class="grid gap-2 px-4 py-3 text-sm sm:grid-cols-2">
                        <p><span class="text-stone-500">Payment:</span> {{ str_replace('_', ' ', $order->payment_method) }}</p>
                        <p><span class="text-stone-500">Fulfillment:</span> {{ ucfirst($order->fulfillment_type) }}</p>
                        <p><span class="text-stone-500">Status:</span> {{ ucfirst($order->status) }}</p>
                    </div>
                    <ul class="border-t border-stone-100 px-4 py-3 text-sm">
                        @foreach ($order->items as $line)
                            <li class="flex justify-between py-1">
                                <span>{{ $line->product_name }} × {{ $line->quantity }}</span>
                                <span>₱{{ number_format((float) $line->unit_price * $line->quantity, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
        <div class="mt-8">{{ $orders->links() }}</div>
    @endif
@endsection
