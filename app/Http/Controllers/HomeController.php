<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredNew = Product::query()->where('featured_new', true)->where('stock', '>', 0)->take(4)->get();
        $featuredTrending = Product::query()->where('featured_trending', true)->where('stock', '>', 0)->take(4)->get();
        $featuredBestseller = Product::query()->where('featured_bestseller', true)->where('stock', '>', 0)->take(4)->get();

        return view('home', compact('featuredNew', 'featuredTrending', 'featuredBestseller'));
    }
}
