<?php

namespace App\Http\Controllers\User;

use App\Models\User\Brand;
use App\Models\User\Category;
use App\Models\User\Color;
use App\Models\User\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController
{
    public function index(Request $request)
    {
        //dd(request('category'));
        //dd($request->all());
        $category = Category::all();
        $brand = Brand::all();
        $color = Color::all();

        $q = Product::query();
        if ($request->has('category')) {
            $q->whereIn('category_id', $request->category);
        }
        if ($request->has('brand')) {
            $q->whereIn('brand_id', $request->brand);
        }
        if ($request->has('color')) {
            $q->whereIn('color_id', $request->color);
        }
        if ($request->has('show')){
            $q->paginate($request->show);
        }
        if (request('sort') === "ID"){
            $q->orderBy("id","asc");
        }
        if (request('sort') === "AZ"){
            $q->orderBy("en_name","asc");
        }
        if (request('sort') === "ZA"){
            $q->orderBy("en_name","DESC");
        }
        if (request('sort') === "HL"){
            $q->orderBy("price","desc");
        }
        if (request('sort') === "LH"){
            $q->orderBy("price","asc");
        }

        $product = $q->get();


        return view('user.category', compact('category', 'brand', 'color', 'product', 'request'));

    }
}
