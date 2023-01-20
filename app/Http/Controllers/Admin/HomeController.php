<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured_product = Product::where('featured', 1)->inRandomOrder(3)->limit(3)->get();
        $new_product = Product::orderBy('id', 'DESC')->inRandomOrder(3)->limit(3)->get();
        $inspired_item = Product::where('inspired', 1)->inRandomOrder(3)->limit(3)->get();
        //dd($featured_product , $new_product , $inspired_item);
        return view('user.index', compact('featured_product', 'new_product', 'inspired_item'));
    }
}
