<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Brand;
use App\Models\User\Category;
use App\Models\User\Color;
use App\Models\User\Photo;
use App\Models\User\Product;
use App\Models\User\Specification;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use function App\Http\Controllers\Admin\public_path;
class ProductController extends Controller
{

    public function index($product_id)
    {
        //dd($product_id);
        $product = Product::find($product_id);
        $specification = Specification::where('product_id',$product_id)->get();
        return view('user.product-details',compact('product','specification'));
    }
}
