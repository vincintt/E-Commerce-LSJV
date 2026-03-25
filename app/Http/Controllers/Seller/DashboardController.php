<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('seller.reports.index');
    }
}
