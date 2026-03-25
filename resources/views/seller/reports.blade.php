@extends('layouts.seller')

@section('title', 'Reports — Seller')

@section('content')
    <h1 class="text-2xl font-bold text-slate-900">Sales &amp; inventory reports</h1>
    <p class="mt-2 text-slate-600">Totals are based on completed orders stored in the database.</p>

    <div class="mt-8 grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-sm font-medium uppercase tracking-wide text-slate-500">Sales today</h2>
            <p class="mt-2 text-3xl font-bold text-emerald-800">₱{{ number_format($salesToday, 2) }}</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-sm font-medium uppercase tracking-wide text-slate-500">Sales this month</h2>
            <p class="mt-2 text-3xl font-bold text-emerald-800">₱{{ number_format($salesMonth, 2) }}</p>
        </div>
    </div>

    <section class="mt-10">
        <h2 class="text-lg font-semibold text-slate-900">Inventory report</h2>
        <p class="mt-1 text-sm text-slate-600">Current stock and unit price per SKU.</p>
        <div class="mt-4 overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Product</th>
                        <th class="px-4 py-3 font-semibold">Stock</th>
                        <th class="px-4 py-3 font-semibold">Unit price</th>
                        <th class="px-4 py-3 font-semibold">Value at retail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($inventory as $row)
                        <tr>
                            <td class="px-4 py-3">{{ $row->name }}</td>
                            <td class="px-4 py-3">{{ $row->stock }}</td>
                            <td class="px-4 py-3">₱{{ number_format($row->price, 2) }}</td>
                            <td class="px-4 py-3">₱{{ number_format((float) $row->price * $row->stock, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
