<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $todayStart = Carbon::today();
        $todayEnd = Carbon::today()->endOfDay();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $salesToday = (float) Order::query()
            ->where('status', 'completed')
            ->whereBetween('created_at', [$todayStart, $todayEnd])
            ->sum('total');

        $salesMonth = (float) Order::query()
            ->where('status', 'completed')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('total');

        $inventory = Product::query()->orderBy('name')->get(['id', 'name', 'stock', 'price']);

        return view('seller.reports', compact('salesToday', 'salesMonth', 'inventory'));
    }
}
